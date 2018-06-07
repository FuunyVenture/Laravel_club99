<?php

/* macros.twig */
class __TwigTemplate_412983d6972fe222d83b4fc467ce13841868048a14097fb340d8a586342f515d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        echo "
";
        // line 14
        echo "
";
        // line 20
        echo "
";
        // line 26
        echo "
";
        // line 42
        echo "
";
        // line 48
        echo "
";
        // line 56
        echo "
";
        // line 60
        echo "
";
        // line 72
        echo "
";
        // line 94
        echo "
";
        // line 106
        echo "
";
        // line 110
        echo "
";
    }

    // line 1
    public function macro_namespace_link($__namespace__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "namespace" => $__namespace__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "<a href=\"";
            echo $this->env->getExtension('Sami\Renderer\TwigExtension')->pathForNamespace($context, (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new Twig_Error_Runtime('Variable "namespace" does not exist.', 2, $this->getSourceContext()); })()));
            echo "\">";
            echo (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new Twig_Error_Runtime('Variable "namespace" does not exist.', 2, $this->getSourceContext()); })());
            echo "</a>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 5
    public function macro_class_link($__class__ = null, $__absolute__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
            "absolute" => $__absolute__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 6
            if (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 6, $this->getSourceContext()); })()), "projectclass", array())) {
                // line 7
                echo "<a href=\"";
                echo $this->env->getExtension('Sami\Renderer\TwigExtension')->pathForClass($context, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 7, $this->getSourceContext()); })()));
                echo "\">";
            } elseif (twig_get_attribute($this->env, $this->getSourceContext(),             // line 8
(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 8, $this->getSourceContext()); })()), "phpclass", array())) {
                // line 9
                echo "<a target=\"_blank\" href=\"http://php.net/";
                echo (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 9, $this->getSourceContext()); })());
                echo "\">";
            }
            // line 11
            echo $this->env->getExtension('Sami\Renderer\TwigExtension')->abbrClass((isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 11, $this->getSourceContext()); })()), ((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) || array_key_exists("absolute", $context) ? $context["absolute"] : (function () { throw new Twig_Error_Runtime('Variable "absolute" does not exist.', 11, $this->getSourceContext()); })()), false)) : (false)));
            // line 12
            if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 12, $this->getSourceContext()); })()), "projectclass", array()) || twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 12, $this->getSourceContext()); })()), "phpclass", array()))) {
                echo "</a>";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 15
    public function macro_method_link($__method__ = null, $__absolute__ = null, $__classonly__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "<a href=\"";
            echo $this->env->getExtension('Sami\Renderer\TwigExtension')->pathForMethod($context, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 16, $this->getSourceContext()); })()));
            echo "\">";
            // line 17
            echo $this->env->getExtension('Sami\Renderer\TwigExtension')->abbrClass(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 17, $this->getSourceContext()); })()), "class", array()));
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) || array_key_exists("classonly", $context) ? $context["classonly"] : (function () { throw new Twig_Error_Runtime('Variable "classonly" does not exist.', 17, $this->getSourceContext()); })()), false)) : (false))) {
                echo "::";
                echo twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 17, $this->getSourceContext()); })()), "name", array());
            }
            // line 18
            echo "</a>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 21
    public function macro_property_link($__property__ = null, $__absolute__ = null, $__classonly__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "property" => $__property__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 22
            echo "<a href=\"";
            echo $this->env->getExtension('Sami\Renderer\TwigExtension')->pathForProperty($context, (isset($context["property"]) || array_key_exists("property", $context) ? $context["property"] : (function () { throw new Twig_Error_Runtime('Variable "property" does not exist.', 22, $this->getSourceContext()); })()));
            echo "\">";
            // line 23
            echo $this->env->getExtension('Sami\Renderer\TwigExtension')->abbrClass(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["property"]) || array_key_exists("property", $context) ? $context["property"] : (function () { throw new Twig_Error_Runtime('Variable "property" does not exist.', 23, $this->getSourceContext()); })()), "class", array()));
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) || array_key_exists("classonly", $context) ? $context["classonly"] : (function () { throw new Twig_Error_Runtime('Variable "classonly" does not exist.', 23, $this->getSourceContext()); })()), true)) : (true))) {
                echo "#";
                echo twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["property"]) || array_key_exists("property", $context) ? $context["property"] : (function () { throw new Twig_Error_Runtime('Variable "property" does not exist.', 23, $this->getSourceContext()); })()), "name", array());
            }
            // line 24
            echo "</a>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 27
    public function macro_hint_link($__hints__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "hints" => $__hints__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 28
            $context["__internal_dde18f5f3d7b8b70d9e60dba702b1a8d9876cf4d6ecbed5a68a258e98906df18"] = $this;
            // line 30
            if ((isset($context["hints"]) || array_key_exists("hints", $context) ? $context["hints"] : (function () { throw new Twig_Error_Runtime('Variable "hints" does not exist.', 30, $this->getSourceContext()); })())) {
                // line 31
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["hints"]) || array_key_exists("hints", $context) ? $context["hints"] : (function () { throw new Twig_Error_Runtime('Variable "hints" does not exist.', 31, $this->getSourceContext()); })()));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["hint"]) {
                    // line 32
                    if (twig_get_attribute($this->env, $this->getSourceContext(), $context["hint"], "class", array())) {
                        // line 33
                        echo $context["__internal_dde18f5f3d7b8b70d9e60dba702b1a8d9876cf4d6ecbed5a68a258e98906df18"]->macro_class_link(twig_get_attribute($this->env, $this->getSourceContext(), $context["hint"], "name", array()));
                    } elseif (twig_get_attribute($this->env, $this->getSourceContext(),                     // line 34
$context["hint"], "name", array())) {
                        // line 35
                        echo $this->env->getExtension('Sami\Renderer\TwigExtension')->abbrClass(twig_get_attribute($this->env, $this->getSourceContext(), $context["hint"], "name", array()));
                    }
                    // line 37
                    if (twig_get_attribute($this->env, $this->getSourceContext(), $context["hint"], "array", array())) {
                        echo "[]";
                    }
                    // line 38
                    if ( !twig_get_attribute($this->env, $this->getSourceContext(), $context["loop"], "last", array())) {
                        echo "|";
                    }
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hint'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 43
    public function macro_source_link($__project__ = null, $__class__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "project" => $__project__,
            "class" => $__class__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 44
            if (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 44, $this->getSourceContext()); })()), "sourcepath", array())) {
                // line 45
                echo "        (<a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 45, $this->getSourceContext()); })()), "sourcepath", array()), "html", null, true);
                echo "\">View source</a>)";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 49
    public function macro_method_source_link($__method__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 50
            if (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 50, $this->getSourceContext()); })()), "sourcepath", array())) {
                // line 51
                echo "        <a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 51, $this->getSourceContext()); })()), "sourcepath", array()), "html", null, true);
                echo "\">line ";
                echo twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 51, $this->getSourceContext()); })()), "line", array());
                echo "</a>";
            } else {
                // line 53
                echo "        line ";
                echo twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 53, $this->getSourceContext()); })()), "line", array());
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 57
    public function macro_abbr_class($__class__ = null, $__absolute__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
            "absolute" => $__absolute__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 58
            echo "<abbr title=\"";
            echo twig_escape_filter($this->env, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 58, $this->getSourceContext()); })()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) || array_key_exists("absolute", $context) ? $context["absolute"] : (function () { throw new Twig_Error_Runtime('Variable "absolute" does not exist.', 58, $this->getSourceContext()); })()), false)) : (false))) ? ((isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 58, $this->getSourceContext()); })())) : (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new Twig_Error_Runtime('Variable "class" does not exist.', 58, $this->getSourceContext()); })()), "shortname", array()))), "html", null, true);
            echo "</abbr>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 61
    public function macro_method_parameters_signature($__method__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 62
            $context["__internal_e8a6aba8696e7bf16880055e277a7e3709c05bd0e7418a562e525a5aface37ca"] = $this->loadTemplate("macros.twig", "macros.twig", 62);
            // line 63
            echo "(";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new Twig_Error_Runtime('Variable "method" does not exist.', 64, $this->getSourceContext()); })()), "parameters", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
                // line 65
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["parameter"], "hashint", array())) {
                    echo $context["__internal_e8a6aba8696e7bf16880055e277a7e3709c05bd0e7418a562e525a5aface37ca"]->macro_hint_link(twig_get_attribute($this->env, $this->getSourceContext(), $context["parameter"], "hint", array()));
                    echo " ";
                }
                // line 66
                echo "\$";
                echo twig_get_attribute($this->env, $this->getSourceContext(), $context["parameter"], "name", array());
                // line 67
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["parameter"], "default", array())) {
                    echo " = ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["parameter"], "default", array()), "html", null, true);
                }
                // line 68
                if ( !twig_get_attribute($this->env, $this->getSourceContext(), $context["loop"], "last", array())) {
                    echo ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo ")";

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 73
    public function macro_render_classes($__classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "classes" => $__classes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 74
            $context["__internal_af311545fd90e4d6019e4218680e837082dfb650ca8e7ece7873ca12fec31892"] = $this;
            // line 75
            echo "
    <div class=\"container-fluid underlined\">
        ";
            // line 77
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new Twig_Error_Runtime('Variable "classes" does not exist.', 77, $this->getSourceContext()); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
                // line 78
                echo "            <div class=\"row\">
                <div class=\"col-md-6\">
                    ";
                // line 80
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["class"], "isInterface", array())) {
                    // line 81
                    echo "                        <em>";
                    echo $context["__internal_af311545fd90e4d6019e4218680e837082dfb650ca8e7ece7873ca12fec31892"]->macro_class_link($context["class"], true);
                    echo "</em>
                    ";
                } else {
                    // line 83
                    echo "                        ";
                    echo $context["__internal_af311545fd90e4d6019e4218680e837082dfb650ca8e7ece7873ca12fec31892"]->macro_class_link($context["class"], true);
                    echo "
                    ";
                }
                // line 85
                echo "                    ";
                echo $context["__internal_af311545fd90e4d6019e4218680e837082dfb650ca8e7ece7873ca12fec31892"]->macro_deprecated($context["class"]);
                echo "
                </div>
                <div class=\"col-md-6\">
                    ";
                // line 88
                echo $this->env->getExtension('Sami\Renderer\TwigExtension')->parseDesc($context, twig_get_attribute($this->env, $this->getSourceContext(), $context["class"], "shortdesc", array()), $context["class"]);
                echo "
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "    </div>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 95
    public function macro_breadcrumbs($__namespace__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "namespace" => $__namespace__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 96
            echo "    ";
            $context["current_ns"] = "";
            // line 97
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_split_filter($this->env, (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new Twig_Error_Runtime('Variable "namespace" does not exist.', 97, $this->getSourceContext()); })()), "\\"));
            foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
                // line 98
                echo "        ";
                if ((isset($context["current_ns"]) || array_key_exists("current_ns", $context) ? $context["current_ns"] : (function () { throw new Twig_Error_Runtime('Variable "current_ns" does not exist.', 98, $this->getSourceContext()); })())) {
                    // line 99
                    echo "            ";
                    $context["current_ns"] = (((isset($context["current_ns"]) || array_key_exists("current_ns", $context) ? $context["current_ns"] : (function () { throw new Twig_Error_Runtime('Variable "current_ns" does not exist.', 99, $this->getSourceContext()); })()) . "\\") . $context["ns"]);
                    // line 100
                    echo "        ";
                } else {
                    // line 101
                    echo "            ";
                    $context["current_ns"] = $context["ns"];
                    // line 102
                    echo "        ";
                }
                // line 103
                echo "        <li><a href=\"";
                echo $this->env->getExtension('Sami\Renderer\TwigExtension')->pathForNamespace($context, (isset($context["current_ns"]) || array_key_exists("current_ns", $context) ? $context["current_ns"] : (function () { throw new Twig_Error_Runtime('Variable "current_ns" does not exist.', 103, $this->getSourceContext()); })()));
                echo "\">";
                echo $context["ns"];
                echo "</a></li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 107
    public function macro_deprecated($__reflection__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "reflection" => $__reflection__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 108
            echo "    ";
            if (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new Twig_Error_Runtime('Variable "reflection" does not exist.', 108, $this->getSourceContext()); })()), "deprecated", array())) {
                echo "<small><sup><span class=\"label label-danger\">deprecated</span></sup></small>";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 111
    public function macro_deprecations($__reflection__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "reflection" => $__reflection__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 112
            echo "    ";
            $context["__internal_48109f2a5ae5a930c3518594d2ca13cba9cf84912f324707fb1f31f134f36428"] = $this;
            // line 113
            echo "
    ";
            // line 114
            if (twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new Twig_Error_Runtime('Variable "reflection" does not exist.', 114, $this->getSourceContext()); })()), "deprecated", array())) {
                // line 115
                echo "        <p>
            ";
                // line 116
                echo $context["__internal_48109f2a5ae5a930c3518594d2ca13cba9cf84912f324707fb1f31f134f36428"]->macro_deprecated((isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new Twig_Error_Runtime('Variable "reflection" does not exist.', 116, $this->getSourceContext()); })()));
                echo "
            ";
                // line 117
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new Twig_Error_Runtime('Variable "reflection" does not exist.', 117, $this->getSourceContext()); })()), "deprecated", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 118
                    echo "                <tr>
                    <td>";
                    // line 119
                    echo twig_get_attribute($this->env, $this->getSourceContext(), $context["tag"], 0, array(), "array");
                    echo "</td>
                    <td>";
                    // line 120
                    echo twig_join_filter(twig_slice($this->env, $context["tag"], 1, null), " ");
                    echo "</td>
                </tr>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 123
                echo "        </p>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "macros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  603 => 123,  594 => 120,  590 => 119,  587 => 118,  583 => 117,  579 => 116,  576 => 115,  574 => 114,  571 => 113,  568 => 112,  556 => 111,  544 => 108,  532 => 107,  514 => 103,  511 => 102,  508 => 101,  505 => 100,  502 => 99,  499 => 98,  494 => 97,  491 => 96,  479 => 95,  470 => 92,  460 => 88,  453 => 85,  447 => 83,  441 => 81,  439 => 80,  435 => 78,  431 => 77,  427 => 75,  425 => 74,  413 => 73,  404 => 70,  388 => 68,  383 => 67,  380 => 66,  375 => 65,  358 => 64,  356 => 63,  354 => 62,  342 => 61,  329 => 58,  316 => 57,  305 => 53,  298 => 51,  296 => 50,  284 => 49,  272 => 45,  270 => 44,  257 => 43,  233 => 38,  229 => 37,  226 => 35,  224 => 34,  222 => 33,  220 => 32,  203 => 31,  201 => 30,  199 => 28,  187 => 27,  178 => 24,  172 => 23,  168 => 22,  154 => 21,  145 => 18,  139 => 17,  135 => 16,  121 => 15,  110 => 12,  108 => 11,  103 => 9,  101 => 8,  97 => 7,  95 => 6,  82 => 5,  69 => 2,  57 => 1,  52 => 110,  49 => 106,  46 => 94,  43 => 72,  40 => 60,  37 => 56,  34 => 48,  31 => 42,  28 => 26,  25 => 20,  22 => 14,  19 => 4,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% macro namespace_link(namespace) -%}
    <a href=\"{{ namespace_path(namespace) }}\">{{ namespace|raw }}</a>
{%- endmacro %}

{% macro class_link(class, absolute) -%}
    {%- if class.projectclass -%}
        <a href=\"{{ class_path(class) }}\">
    {%- elseif class.phpclass -%}
        <a target=\"_blank\" href=\"http://php.net/{{ class|raw }}\">
    {%- endif %}
    {{- abbr_class(class, absolute|default(false)) }}
    {%- if class.projectclass or class.phpclass %}</a>{% endif %}
{%- endmacro %}

{% macro method_link(method, absolute, classonly) -%}
    <a href=\"{{ method_path(method) }}\">
        {{- abbr_class(method.class) }}{% if not classonly|default(false) %}::{{ method.name|raw }}{% endif -%}
    </a>
{%- endmacro %}

{% macro property_link(property, absolute, classonly) -%}
    <a href=\"{{ property_path(property) }}\">
        {{- abbr_class(property.class) }}{% if not classonly|default(true) %}#{{ property.name|raw }}{% endif -%}
    </a>
{%- endmacro %}

{% macro hint_link(hints) -%}
    {%- from _self import class_link %}

    {%- if hints %}
        {%- for hint in hints %}
            {%- if hint.class %}
                {{- class_link(hint.name) }}
            {%- elseif hint.name %}
                {{- abbr_class(hint.name) }}
            {%- endif %}
            {%- if hint.array %}[]{% endif %}
            {%- if not loop.last %}|{% endif %}
        {%- endfor %}
    {%- endif %}
{%- endmacro %}

{% macro source_link(project, class) -%}
    {% if class.sourcepath %}
        (<a href=\"{{ class.sourcepath }}\">View source</a>)
    {%- endif %}
{%- endmacro %}

{% macro method_source_link(method) -%}
    {% if method.sourcepath %}
        <a href=\"{{ method.sourcepath }}\">line {{ method.line|raw }}</a>
    {%- else %}
        line {{ method.line|raw }}
    {%- endif %}
{%- endmacro %}

{% macro abbr_class(class, absolute) -%}
    <abbr title=\"{{ class }}\">{{ absolute|default(false) ? class : class.shortname }}</abbr>
{%- endmacro %}

{% macro method_parameters_signature(method) -%}
    {%- from \"macros.twig\" import hint_link -%}
    (
        {%- for parameter in method.parameters %}
            {%- if parameter.hashint %}{{ hint_link(parameter.hint) }} {% endif -%}
            \${{ parameter.name|raw }}
            {%- if parameter.default %} = {{ parameter.default }}{% endif %}
            {%- if not loop.last %}, {% endif %}
        {%- endfor -%}
    )
{%- endmacro %}

{% macro render_classes(classes) -%}
    {% from _self import class_link, deprecated %}

    <div class=\"container-fluid underlined\">
        {% for class in classes %}
            <div class=\"row\">
                <div class=\"col-md-6\">
                    {% if class.isInterface %}
                        <em>{{ class_link(class, true) }}</em>
                    {% else %}
                        {{ class_link(class, true) }}
                    {% endif %}
                    {{ deprecated(class) }}
                </div>
                <div class=\"col-md-6\">
                    {{ class.shortdesc|desc(class) }}
                </div>
            </div>
        {% endfor %}
    </div>
{%- endmacro %}

{% macro breadcrumbs(namespace) %}
    {% set current_ns = '' %}
    {% for ns in namespace|split('\\\\') %}
        {% if current_ns %}
            {% set current_ns = current_ns ~ '\\\\' ~ ns %}
        {% else %}
            {% set current_ns = ns %}
        {% endif %}
        <li><a href=\"{{ namespace_path(current_ns) }}\">{{ ns|raw }}</a></li>
    {% endfor %}
{% endmacro %}

{% macro deprecated(reflection) %}
    {% if reflection.deprecated %}<small><sup><span class=\"label label-danger\">deprecated</span></sup></small>{% endif %}
{% endmacro %}

{% macro deprecations(reflection) %}
    {% from _self import deprecated %}

    {% if reflection.deprecated %}
        <p>
            {{ deprecated(reflection )}}
            {% for tag in reflection.deprecated %}
                <tr>
                    <td>{{ tag[0]|raw }}</td>
                    <td>{{ tag[1:]|join(' ')|raw }}</td>
                </tr>
            {% endfor %}
        </p>
    {% endif %}
{% endmacro %}
", "macros.twig", "phar://C:/Users/Ionut/Downloads/sami.phar/Sami/Resources/themes\\default/macros.twig");
    }
}
