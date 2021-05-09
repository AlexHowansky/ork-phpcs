* Require @param and @return comments only when we don't have native typehints.
* Create a custom version of Squiz.WhiteSpace.ObjectOperatorSpacing.Before to
  allow white space before the object operator, but only when it's the first
  thing on the line, and it's indented one indent.
