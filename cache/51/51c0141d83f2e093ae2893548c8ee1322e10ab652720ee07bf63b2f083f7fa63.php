<?php

/* index.html */
class __TwigTemplate_49a1b1a7621273e3af6ff12886d00c555e7b68cd338aca86d2be173a0f7351b5 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "</title>
</head>
<body>
    hello,";
        // line 8
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 8,  29 => 5,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.html", "/data/php/Lena/resources/templates/index.html");
    }
}
