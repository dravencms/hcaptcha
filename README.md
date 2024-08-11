# DravenCMS hCaptcha package

This is a Draven CMS hcaptcha package implementing dravencms/captcha-impl using mitloshuk/hcaptcha

## Instalation

The best way to install dravencms/hcaptcha is using  [Composer](http://getcomposer.org/):


```sh
$ composer require dravencms/hcaptcha
```

After installation add this code to your `app/config/settings.neon`

```neon
hcaptcha:
	secretKey: 6Lfv2A4UAAAAAPg8HMcwsXXXXXXXXXXXXXXX  # Use your own secretKey
	siteKey: 6Lfv2A4UAAAAAKkmkrDnXXXXXXXXXXXXXXX  # Use your own site key
```
