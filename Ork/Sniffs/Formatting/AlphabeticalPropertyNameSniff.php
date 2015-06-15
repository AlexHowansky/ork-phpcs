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
 * Ensures class properties are defined in alphabetical order.
 */
class Ork_Sniffs_Formatting_AlphabeticalPropertyNameSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * The scope closer for the current scope.
     *
     * @var type
     */
    protected $closer = null;

    /**
     * Track the last variable name we encountered.
     *
     * @var string
     */
    protected $lastVariableName = null;

    /**
     * Register the tokens we're interested in.
     *
     * @return array
     */
    public function register()
    {
        return [T_CLASS, T_INTERFACE, T_TRAIT, T_FUNCTION, T_VARIABLE];
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

        $tokens = $phpcsFile->getTokens()[$stackPtr];

        // Ignore everything after the first method delcaration.
        if ($tokens['code'] === T_FUNCTION) {
            return $phpcsFile->numTokens + 1;
        }

        // Start of a new class, reset the list.
        if (in_array($tokens['code'], [T_CLASS, T_INTERFACE, T_TRAIT])) {
            $this->closer = $tokens['scope_closer'];
            $this->inFunction = false;
            $this->lastVariableName = null;
            return;
        }

        // Not in a class, skip.
        if ($this->closer === null || $tokens['line'] > $this->closer) {
            return;
        }

        // Make sure this variable name is greater than the last one we encountered.
        $variableName = $tokens['content'];
        if ($this->lastVariableName !== null && $variableName <= $this->lastVariableName) {
            $phpcsFile->addError('Property "%s" is not in alphabetical order.', $stackPtr, 'Found', [$variableName]);
        }

        $this->lastVariableName = $variableName;

    }

}