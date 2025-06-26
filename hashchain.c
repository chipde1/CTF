#include <inttypes.h>
#include <openssl/bio.h>
#include <openssl/evp.h>
#include <stdbool.h>
#include <stdio.h>
#include <string.h>

struct hash_chain{
    int digest_size;
    int chain_length;
    uint8_t *data;
};

struct hash_chain hash_chain_create(void *base, int baselen, const EVP_MD *type, int chain_len)
{
    EVP_MD_CTX *ctx;
    struct hash_chain output;

    output.digest_size = EVP_MD_size(type);
    output.chain_length = chain_len;
    output.data = calloc(output.chain_length, output.digest_size);

    ctx = EVP_MD_CTX_create();
    EVP_DigestInit_ex(ctx, type, NULL);
    EVP_DigestUpdate(ctx, base, baselen);
    EVP_DigestFinal_ex(ctx, output.data, NULL);

    for (int idx = 1; idx < output.chain_length; idx++){
        EVP_DigestInit_ex(ctx, type, NULL);
        EVP_DigestUpdate(ctx, output.data + (idx-1) * output.digest_size, output.digest_size);
        EVP_DigestFinal_ex(ctx, output.data + idx * output.digest_size, NULL);
    }

    EVP_MD_CTX_destroy(ctx);
    return output;
}

bool hash_chain_verify(const void *h, const void *tip, const EVP_MD *hash)
{
    EVP_MD_CTX *ctx;
    int result;
    int digest_len = EVP_MD_size(hash);
    void *data = malloc(digest_len);

    ctx = EVP_MD_CTX_create();
    EVP_DigestInit_ex(ctx, hash, NULL);
    EVP_DigestUpdate(ctx, h, digest_len);
    EVP_DigestFinal_ex(ctx, data, NULL);
    EVP_MD_CTX_destroy(ctx);

    result = memcmp(data, tip, digest_len);
    free(data);

    return result == 0;
}

void hash_chain_print(struct hash_chain chain, FILE *f)
{
    for (int i = 0; i < chain.chain_length; i++) {
        for (int j = 0; j < chain.digest_size; j++) {
            fprintf(f, "%02x", chain.data[i * chain.digest_size + j]);
        }
        fprintf(f, "\n");  // 각 해시 출력 후 새 줄 추가
    }
}

void *base64_decode(char *str, int explen)
{
  uint8_t *buf = malloc(explen);
  BIO *b = BIO_new_mem_buf(str, -1);
  BIO *b64 = BIO_new(BIO_f_base64());
  BIO_push(b64, b);
  BIO_set_flags(b64, BIO_FLAGS_BASE64_NO_NL);
  BIO_read(b64, buf, explen);
  BIO_free_all(b64);
  return buf;
}

int cmd_create(int argc, char **argv)
{
  if (argc < 4) {
    fprintf(stderr, "error: too few args\n");
    fprintf(stderr, "usage: %s HASH LENGTH BASE\n", argv[0]);
    return EXIT_FAILURE;
  }

  const EVP_MD *hash = EVP_get_digestbyname(argv[1]);
  if (hash == NULL) {
    fprintf(stderr, "error: hash %s doesn't exist\n", argv[1]);
    return EXIT_FAILURE;
  }

  int length;
  if (sscanf(argv[2], "%d", &length) != 1) {
    fprintf(stderr, "error: can't convert %s to integer\n", argv[2]);
    return EXIT_FAILURE;
  }

  struct hash_chain chain = hash_chain_create(argv[3], strlen(argv[3]), hash, length);
  hash_chain_print(chain, stdout);
  free(chain.data);

  return EXIT_SUCCESS;
}

int cmd_verify(int argc, char **argv)
{
  if (argc < 4) {
    fprintf(stderr, "error: too few args\n");
    fprintf(stderr, "usage: %s ALGO QUERY ANCHOR\n", argv[0]);
    return EXIT_FAILURE;
  }

  const EVP_MD *hash = EVP_get_digestbyname(argv[1]);
  if (hash == NULL) {
    fprintf(stderr, "error: hash %s doesn't exist\n", argv[1]);
    return EXIT_FAILURE;
  }

  int digest_len = EVP_MD_size(hash);
  void *qhash = base64_decode(argv[2], digest_len);
  void *thash = base64_decode(argv[3], digest_len);

  bool res = hash_chain_verify(qhash, thash, hash);
  free(qhash);
  free(thash);
  if (res) {
    printf("success\n");
    return EXIT_SUCCESS;
  } else {
    printf("failure\n");
    return EXIT_FAILURE;
  }
}

int main(int argc, char **argv)
{
  if (argc < 2) {
    fprintf(stderr, "error: subcommand required\n");
    return EXIT_FAILURE;
  }

  OpenSSL_add_all_digests();
  int rv;

  if (strcmp(argv[1], "create") == 0) {
    rv = cmd_create(argc - 1, argv + 1);
  } else if (strcmp(argv[1], "verify") == 0) {
    rv = cmd_verify(argc - 1, argv + 1);
  } else {
    fprintf(stderr, "error: subcommand %s not found\n", argv[1]);
    rv = EXIT_FAILURE;
  }

  EVP_cleanup();
  return rv;
}
