<?php
/* $Id$ */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */


/**
 * Compile <motif:date:format var="varName" format="%m/%d/%Y" />
 */
class Motif_Tag_Compiler_Date_Format extends Motif_Tag_Compiler_Abstract
{

    /**
     * @var string Tag's name
     */
    protected $_tagName = 'date:format';

    /**
     * @var boolean Tag has pairs? (opening and closing)
     */
    protected $_hasTagPairs = false;

    /**
     * Declare attributes for this tag
     *
     * @return void
     */
    protected function _declareAttributes()
    {
        $this->_attributes = array(
            'var'       => new Motif_Tag_Attribute_Required(self::MATCH_VAR),
            'format'    => new Motif_Tag_Attribute_Required(self::MATCH_WILDCARD),
        );
    }

    /**
     * Compile tag matches to native PHP code
     */
    protected function _compileMatches()
    {
        foreach ($this->_tagMatches as $match)
        {
            $varCode = $this->_parseVarName($this->getAttribute('var'));
            $format = $this->getAttribute('format');

            $code = '' .
                '\');' . NL .
                "if (isset({$varCode}))" . NL .
                '{' . NL .
                    "echo date('{$format}', strtotime({$varCode}));" . NL .
                '}' . NL .
                'echo(\'';

            /**
             * Do replacement
             */
            $this->_replaceCode($code);
        }
    }

}
