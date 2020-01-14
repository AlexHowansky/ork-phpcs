<?php
/**
 * Ensures class properties are declared in alphabetical order.
 *
 * @author    Alex Howansky <alex.howansky@gmail.com>
 * @copyright 2016 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Ork\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class AlphabeticalPropertyNamesSniff implements Sniff
{

    /**
     * Track the last property name we encountered.
     *
     * @var string
     */
    protected $lastPropertyName = null;


    /**
     * Register the tokens we're interested in.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_CLASS,
            T_INTERFACE,
            T_TRAIT,
            T_VARIABLE,
        ];

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // In case we have more than one class/interface/trait
        // per file, we want to reset at the start of each.
        if ($tokens[$stackPtr]['code'] !== T_VARIABLE) {
            $this->lastPropertyName = null;
            return;
        }

        // We only care about class properties, so ignore global
        // variables (level 0) and method variables (level 2).
        if ($tokens[$stackPtr]['level'] === 1) {
            $propertyName = substr($tokens[$stackPtr]['content'], 1);
            if ($this->lastPropertyName !== null
                && strtolower($propertyName) <= $this->lastPropertyName
                && array_key_exists('nested_parenthesis', $tokens[$stackPtr]) === false
            ) {
                $phpcsFile->addError('Property "%s" is not in alphabetical order.', $stackPtr, 'OutOfOrder', [$propertyName]);
            }

            $this->lastPropertyName = strtolower($propertyName);
        }

    }//end process()


}//end class
