no Ubuntu execute os seguintes comandos, para instalar o codesniffer

`$ sudo composer global require "squizlabs/php_codesniffer=*"`

`$ sudo composer global require "phpcompatibility/php-compatibility=*"`

`$ vim /home/SEU_USUARIO/.bashrc`

Add ao final do arquivo

```bash
## Custom
export PATH=~/.composer/vendor/bin:$PATH
export APP_ENV=desenvolvimento
```

salve e saia, execute o comando abaixo

`$ source /home/SEU_USUARIO/.bashrc`

configure o php-compatibility no phpcs

`$ phpcs --config-set installed_paths /home/SEU_USUARIO/.composer/vendor/phpcompatibility/php-compatibility/`

Certifique a instalação com o comando

`$ phpcs -i`

o resultado deve ser proximo ao abaixo.

`The installed coding standards are MySource, PEAR, PSR1, PSR12, PSR2, Squiz, Zend and PHPCompatibility`

## IDE (PHPSTORM)

Configura o codesniffer com phpremoto no phpstorm, lembrar de configurar seu SSH no subsistema, utilizando o aquivo md desse repositório até o passo 4

Configure o mapeamento do projeto e do codesniffer

PASTA NO WINDOWS, PASTA NO LINUX (`/mnt/f/p21/sistemas/web/apache/cra`)

PHPCODESNIFFER PATH (PHPSTORM)

`/home/SEU_USUARIO/.composer/vendor/squizlabs/php_codesniffer/bin/phpcs`

File -> Settings -> Editor -> Inspections -> PHP -> Quality tools -> PHP Code Sniffer validation

No campo "Coding standard" clique no ícone de "atualizar" e selecione a opção "PHPCompatibility"
