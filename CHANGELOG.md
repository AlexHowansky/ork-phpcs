CHANGELOG
=========

1.0.0
-----
* Initial commit.

1.1.0
-----
* Added Commenting/FileCommentSniff.
* Added Formatting/AlphabeticalFunctionNameSniff.
* Added Formatting/AlphabeticalVariableNameSniff.

1.2.0
-----
* Renamed Formatting/AlphabeticalVariableNameSniff to Formatting/AlphabeticalPropertyNameSniff.
* Updated Formatting/AlphabeticalPropertyNameSniff so that it ignores variables outside classes/interfaces/traits.
* Added a custom version of Squiz_Sniffs_PHP_DisallowComparisonAssignmentSniff to address a bug they won't acknowledge.

1.3.0
-----
* Added a custom version of PEAR_Sniffs_ControlStructures_MultiLineConditionSniff to handle preferred formatting for
  multi-line conditionals.
* Added a custom version of PSR2_Sniffs_WhiteSpace_ControlStructureSpacingSniff to allow newline immediately after
  open for multi-line conditionals.

1.3.1
-----
* Removed use of Squiz_Sniffs_Formatting_OperatorBracketSniff.
