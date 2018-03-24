<?php
/**
 * Ensures class methods are declared in alphabetical order.
 *
 * @author    Alex Howansky <alex.howansky@gmail.com>
 * @copyright 2016 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Ork\Sniffs\Formatting;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class AlphabeticalMethodNamesSniff implements Sniff
{

    /**
     * Track the last method name we encountered.
     *
     * @var string
     */
    protected $lastMethodName = null;


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
            T_FUNCTION,
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
        if ($tokens[$stackPtr]['code'] !== T_FUNCTION) {
            $this->lastMethodName = null;
            return;
        }

        // We only care about class methods, so ignore global functions (level 0).
        if ($tokens[$stackPtr]['level'] === 1) {
            $methodName = $phpcsFile->getDeclarationName($stackPtr);
            if ($this->lastMethodName !== null && $methodName <= $this->lastMethodName) {
                $phpcsFile->addError('Method "%s" is not in alphabetical order.', $stackPtr, 'OutOfOrder', [$methodName]);
            }

            $this->lastMethodName = $methodName;
        }

    }//end process()


}//end class
