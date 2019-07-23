<?php

namespace In2code\Powermail\Utility;
use TYPO3\CMS\Core\Utility\GeneralUtility;



class CsrfUtility {
	/**
	 *
	 * @var string
	 */
	const SESSION_KEY = 'powermail-csrfToken';

	/**
	 * @var int
	 */
	const TOKEN_LENGTH = 64;

	/**
	 * Creates a token for CSRF Security
	 *
	 * @return string
	 */
	protected static function createToken() {
		return 	GeneralUtility::getRandomHexString(self::TOKEN_LENGTH);
	}

	/**
	 * Creates a token for CSRF Security
	 * and stores in session
	 *
	 * @param string $key
	 * @return string
	 */
	public static function createAndStoreToken($key= '') {
		$token = self::createToken();
		$GLOBALS['TSFE']->fe_user->setAndSaveSessionData(self::SESSION_KEY . $key, $token);

		return $token;
	}

	/**
	 * @param string $key
	 * @param string $token
	 * @return bool
	 */
	public static function checkToken($key = '', $token = '') {
		return !!$token
			&& strlen($token) === self::TOKEN_LENGTH
			&& $GLOBALS['TSFE']->fe_user->getSessionData(self::SESSION_KEY . $key) === $token;
	}

	/**
	 * @param string $key
	 */
	public static function unsetToken($key= '') {
		$GLOBALS['TSFE']->fe_user->setKey('ses', self::SESSION_KEY . $key, '');
	}

}