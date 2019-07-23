<?php
namespace In2code\Powermail\Domain\Validator;

use In2code\Powermail\Domain\Model\Mail;
use In2code\Powermail\Utility\CsrfUtility;



/**
 * format fields before validation
 *
 *
 */
class CsrfTokenValidator extends \In2code\Powermail\Domain\Validator\AbstractValidator {

	/**
	 * @param \In2code\Powermail\Domain\Model\Mail $mail
	 * @return bool
	 */
	public function isValid($mail) {
		$isValid = CsrfUtility::checkToken($mail->getForm()->getUid(), $mail->getCsrfToken());

		if(!$isValid) {
			$this->addError('CSRF');
		}
		return $isValid;
	}
}