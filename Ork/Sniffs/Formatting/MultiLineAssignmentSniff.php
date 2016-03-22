<?php

/**
 * Ork PHPCS
 *
 * @package   Ork_PHPCS
 * @copyright 2016 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-phpcs/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-phpcs
 */

/**
 * Ensures that multi-line assignments are formatted correctly.
 */
class Ork_Sniffs_Formatting_MultiLineAssignmentSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * The number of spaces code should be indented.
     *
     * @var int
     */
    public $indent = 4;

    /**
     * Register the tokens we're interested in.
     *
     * @return array
     */
    public function register()
    {
        return array(T_EQUAL);
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

        $tokens = $phpcsFile->getTokens();

        // Only consider multi-line statements.
        $start = $phpcsFile->findStartOfStatement($stackPtr);
        $end = $phpcsFile->findEndOfStatement($stackPtr);
        if ($tokens[$start]['line'] === $tokens[$end]['line']) {
            return;
        }

        // The equals sign should be the last thing on the line.
        $next = $phpcsFile->findNext(T_WHITESPACE, $stackPtr + 1, null, true);
        if (
            $next === false ||
            $tokens[$next]['code'] === T_ARRAY ||
            $tokens[$next]['code'] === T_OPEN_SHORT_ARRAY
        ) {
            return;
        }
        if ($tokens[$next]['line'] !== $tokens[$stackPtr]['line'] + 1) {
            $phpcsFile->addError(
                'The first line of a multi-line assignment must end with an equals sign',
                $stackPtr,
                'EqualSignLine'
            );
        }

        // The equals sign should not be the first thing on the line.
        $prev = $phpcsFile->findPrevious(T_WHITESPACE, $stackPtr - 1, null, true);
        if ($prev === false) {
            return;
        }
        if ($tokens[$prev]['line'] !== $tokens[$stackPtr]['line']) {
            $phpcsFile->addError(
                'Multi-line assignments must have the equal sign on the first line',
                $stackPtr,
                'EqualSignLine'
            );
        }

        // Find the start of the current line.
        for ($i = $stackPtr - 1; $i >= 0; $i--) {
            if ($tokens[$i]['line'] !== $tokens[$stackPtr]['line']) {
                ++$i;
                break;
            }
        }

        // Find the indent on this line.
        $indent = $tokens[$i]['code'] === T_WHITESPACE ? $tokens[$i]['length'] : 0;

        // Calculate the indent for the remaining lines.
        $indent += $this->indent;

        // Make sure all lines until the end of the statement match.
        $last = $tokens[$stackPtr]['line'];
        for ($i = $stackPtr + 1; $i <= $end; $i++) {
            if ($tokens[$i]['line'] === $last) {
                continue;
            }
            $last = $tokens[$i]['line'];
            if ($tokens[$i]['length'] !== $indent) {
                $phpcsFile->addError(
                    'Multi-line assignment not indented correctly; expected %s spaces but found %s',
                    $stackPtr,
                    'Indent',
                    array($indent, $tokens[$i]['length'])
                );
            }
        }

    }

}
