# CHANGELOG

## 2.5.2

* Removed redundant sniff Generic.Files.EndFileNewline.

## 2.5.1

* Added progress indicator and cache arguments to the default configuration.

## 2.5.0

* Removed PEAR.NamingConventions.ValidVariableName.PrivateNoUnderscore because
  it should have never been there.
* Removed Squiz.Commenting.FunctionComment.SpacingAfterParamType and
  Squiz.Commenting.FunctionComment.SpacingAfterParamName because they're really
  counterproductive when using the new compound types.

## 2.4.0

* Removed Squiz.Commenting.FunctionComment.MissingParamTag and
  Squiz.Commenting.FunctionComment.MissingReturn because this
  functionality now should be provided by native typehints.

## 2.3.0

* Added new Generic sniffs.

## 2.2.0

* Added new PSR12 sniffs.

## 2.1.0

* Updated Ork.Formatting.AlphabeticalPropertyNames and
  Ork.Formatting.AlphabeticalMethodNames to be case insensitive.
* Added unit tests.

## 2.0.12

* Removed Squiz.WhiteSpace.ObjectOperatorSpacing.Before sniff to allow
  stacking chained method calls over multiple lines.

## 2.0.11

* Removed conflicting Squiz.ControlStructures.ElseIfDeclaration sniff.

## 2.0.10

* Resolved issue #1.

## 2.0.9

* Removed redundant Squiz.Operators.ComparisonOperatorUsage sniff.

## 2.0.8

* Removed Squiz.Arrays.ArrayDeclaration.DoubleArrowNotAligned sniff.

## 2.0.7

* Removed some redundant tests.

## 2.0.6

* Updated to PHPCS v3.4.0.

## 2.0.5

* Updated to PHPCS v3.2.3.

## 2.0.4

* Updated Ork.PHP.DisallowComparisonAssignment to allow assignments using the
  null coalesce operator.

## 2.0.3

* Added Ork.Operators.ComparisonOperatorUsageSniff to override
  Squiz.Operators.ComparisonOperatorUsageSniff and allow ternary shortcut
  operator.

## 2.0.2

* Minor tweaks in new sniffs.

## 2.0.1

* Minor tweaks in new sniffs.

## 2.0.0

* Updated to work with PHPCS v3.

## 1.4.1

* AlphabeticalPropertyNameSniff now ignores method parameters.

## 1.4.0

* Added unit test scaffolding and a few tests.
* Made custom sniff code comply with PHPCS standard.
* Renamed AlphabeticalFunctionNameSniff to AlphabeticalMethodNamesSniff.
* Renamed AlphabeticalPropertyNameSniff to AlphabeticalPropertyNamesSniff.

## 1.3.5

* Added Ork.Formatting.MultiLineAssignment.

## 1.3.4

* Updated Ork.PHP.DisallowComparisonAssignment to allow comparisons when
  explicitly cast to boolean.

## 1.3.3

* Removed use of Squiz.Objects.ObjectInstantiation.NotAssigned.

## 1.3.2

* Removed use of PEAR.Functions.FunctionCallSignature.

## 1.3.1

* Removed use of Squiz.Formatting.OperatorBracket.

## 1.3.0

* Added a custom version of PEAR.ControlStructures.MultiLineCondition to handle
  preferred formatting for multi-line conditionals.
* Added a custom version of PSR2.WhiteSpace.ControlStructureSpacing to allow
  newline immediately after open for multi-line conditionals.

## 1.2.0

* Renamed Ork.Formatting.AlphabeticalVariableName to
 Ork.Formatting.AlphabeticalPropertyName.
* Updated Ork.Formatting.AlphabeticalPropertyName so that it ignores variables
  outside classes/interfaces/traits.
* Added a custom version of Squiz.PHP.DisallowComparisonAssignment to address a
  bug they won't acknowledge.

## 1.1.0

* Added Ork.Commenting.FileComment.
* Added Ork.Formatting.AlphabeticalFunctionName.
* Added Ork.Formatting.AlphabeticalVariableName.

## 1.0.0

* Initial commit.
