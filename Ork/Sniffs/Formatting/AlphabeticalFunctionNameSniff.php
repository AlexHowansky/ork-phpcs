<?php

/**
 * Ork PHPCS
 *
 * @package   Ork_PHPCS
 * @copyright 2015 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-phpcs/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-phpcs
 */

/**
 * Ensures methods are defined in alphabetical order.
 */
class Ork_Sniffs_Formatting_AlphabeticalFunctionNameSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * Track the last function name we encountered.
     *
     * @var string
     */
    protected $lastFunctionName = null;

    /**
     * Register the tokens we're interested in.
     *
     * @return array
     */
    public function register()
    {
        return [T_CLASS, T_TRAIT, T_INTERFACE, T_FUNCTION];
    }

    /**
     * Process a token.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int $stackPtr The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {

        // New class, reset the list.
        if (in_array($phpcsFile->getTokens()[$stackPtr]['code'], [T_CLASS, T_TRAIT, T_INTERFACE])) {
            $this->lastFunctionName = null;
            return;
        }

        // Make sure this function name is greater than the last one we encountered.
        $functionName = $phpcsFile->getDeclarationName($stackPtr);
        if ($this->lastFunctionName !== null && $functionName < $this->lastFunctionName) {
            $phpcsFile->addError('Function "%s" is not in alphabetical order.', $stackPtr, 'Found', [$functionName]);
        }

        $this->lastFunctionName = $functionName;

    }

}
