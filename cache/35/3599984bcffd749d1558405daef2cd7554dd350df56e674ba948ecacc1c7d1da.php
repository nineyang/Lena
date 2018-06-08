<?php

/* demo/index.html */
class __TwigTemplate_ac2ae48f26ca41aac2e9cb720efdd7fec4851e091ab317499a0750447b51761a extends Twig_Template
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
        return "demo/index.html";
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
        return new Twig_Source("", "demo/index.html", "/data/php/Lena/resources/templates/demo/index.html");
    }
}
