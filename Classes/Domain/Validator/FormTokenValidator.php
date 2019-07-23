<?php
declare(strict_types=1);
namespace In2code\Powermail\Domain\Validator;

use In2code\Powermail\Domain\Model\Mail;
use In2code\Powermail\Signal\SignalTrait;

/**
 * Class FormTokenValidator
 */
class FormTokenValidator extends AbstractValidator
{


	/**
	 * Validate FormToken
	 *
	 * @param Mail $mail
	 * @return bool
	 */
	public function isValid($mail)
	{
		return \TYPO3\CMS\Core\FormProtection\FormProtectionFactory::get()->validateToken(
			(string) \TYPO3\CMS\Core\Utility\GeneralUtility::_POST('formToken'),
			'Powermail', 'form', $mail->getForm()->getUid());
	}
}
