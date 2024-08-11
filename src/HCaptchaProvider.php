<?php declare(strict_types = 1);

namespace Dravencms\HCaptcha;

use Nette\SmartObject;
use Dravencms\Captcha\ICaptchaProvider;
use Dravencms\Captcha\Forms\ICaptchaField;
use Dravencms\HCaptcha\Forms\HCaptchaField;
use HCaptcha\hCaptcha;
use HCaptcha\Responses\Response;
use Nette\Forms\Controls\BaseControl;

class HCaptchaProvider extends hCaptcha implements ICaptchaProvider
{
    use SmartObject;


    /** @var callable[] */
	public array $onValidate = [];

	/** @var callable[] */
	public array $onValidateControl = [];

	private string $siteKey;

    const FORM_PARAMETER = 'h-captcha-response';

    public function __construct(string $siteKey, string $secretKey)
    {
        parent::__construct($secretKey);
        $this->siteKey = $siteKey;
    }

    public function getSiteKey(): string
	{
		return $this->siteKey;
	}

    public function validate(string $response): ?Response
	{
		// Fire events!
		$this->onValidate($this, $response);

        return $this->verify($response);
	}

	public function validateControl(BaseControl $control): bool
	{
		// Fire events!
		$this->onValidateControl($this, $control);

		// Get response
		/** @var scalar $value */
		$value = $control->getValue();
		$response = $this->validate(strval($value));


		return $response->isSuccess();
	}

    public function prepareField(string $label, ?string $message = null): ICaptchaField {
        return new HCaptchaField($this, $label, $message);
    }
}
