<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/userprofile/templates/profile-custom-template.html.twig */
class __TwigTemplate_de7239ed8c1acaf40f85d084c0807e07 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 1) == "theme1")) {
            // line 2
            echo "<section id=\"sec1\">
\t<div class=\"container-fluid\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-lg-4 offset-lg-1 col-md-5 order-lg-2 order-sm-2 img-bg\">
\t\t\t\t<img class=\"img-fluid float-end docimg\" src=\"";
            // line 6
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 6), "field_background_image", [], "any", false, false, true, 6), "url", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 6), "field_background_image", [], "any", false, false, true, 6), "alt", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
            echo "\">
\t\t\t</div>
\t\t\t<div class=\"svg d-block d-sm-none\">
\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\">
\t\t\t\t\t<path fill=\"#4c94d3\" fill-opacity=\"1\" d=\"M0,128L80,144C160,160,320,192,480,197.3C640,203,800,181,960,149.3C1120,117,1280,75,1360,53.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z\"></path>
\t\t\t\t</svg>
\t\t\t</div>
\t\t\t<div class=\"col-lg-7 col-md-7 intro-box order-lg-1 order-sm-1\">
\t\t\t\t<h1 class=\"fs-1 tc\">";
            // line 14
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 14), "field_name", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
            echo "</h1>
\t\t\t\t<p class=\"title tc\">";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 15), "field_speciality", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
            echo " </p>
\t\t\t\t<p style=\"margin-top: -10px;\" class=\"tc\">";
            // line 16
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 16), "field_degree", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
            echo " </p>
\t\t\t\t<div class=\"d-block d-sm-none\" style=\"margin-top: -20px;\">
\t\t\t\t\t<p class=\"pt-4 fs-4 m-3 tc\">";
            // line 18
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 18), "field_phone_number", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 18), "field_email_address", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
            echo "</p>
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-7 bg-change\">
\t\t\t\t\t\t<div class=\"sm-fl\">
\t\t\t\t\t\t\t<button class=\"btn appbtn rounded-pill mb-2 order-lg-2 order-sm-2\">Make an appointment</button>
\t\t\t\t\t\t\t<button class=\"whatsappbtn btn mb-2 d-block d-sm-none\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<p class=\"pt-4 fs-6 mb-4 d-none d-sm-block\">";
            // line 26
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 26), "field_phone_number", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
            echo " <br>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 26), "field_email_address", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
            echo "</p>
\t\t\t\t\t\t<div class=\"rating float-start mb-3 mt-3 order-lg-2 order-sm-2\" id=\"rating\">
\t\t\t\t\t\t\t<span class=\"star\" data-value=\"1\">&#9733;</span>
\t\t\t\t\t\t\t<span class=\"star\" data-value=\"2\">&#9733;</span>
\t\t\t\t\t\t\t<span class=\"star\" data-value=\"3\">&#9733;</span>
\t\t\t\t\t\t\t<span class=\"star\" data-value=\"4\">&#9733;</span>
\t\t\t\t\t\t\t<span class=\"star\" data-value=\"5\">&#9733;</span>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-5 d-none d-sm-block\">
\t\t\t\t\t\t<button class=\"whatsappbtn btn mb-2\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button>
\t\t\t\t\t\t<p class=\"exp mt-3\"><span class=\"ten\">";
            // line 37
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 37), "field_experiences", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
            echo " Years</span></p>
\t\t\t\t\t\t<p class=\"fs-5 fw-bold mx-1 mb-4\" style=\"margin-top: -30px;\"><span class=\"ex\">Experience</span></p>
\t\t\t\t\t\t<p class=\"exp mb-4\"><span class=\"ten\">";
            // line 39
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 39), "field_patients", [], "any", false, false, true, 39), 39, $this->source), "html", null, true);
            echo "</span> Patients</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"sm-fl bg-change d-flex\">
\t\t\t\t\t\t";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 42), "field_logos", [], "any", false, false, true, 42));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                // line 43
                echo "\t\t\t\t\t\t\t<div class=\"col-sm-4 mt-2 mb-2 m-2\">
\t\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"";
                // line 44
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 44), "url", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
                echo "\" alt=\"\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</section>
";
        } else {
            // line 54
            echo "\t<section id=\"p2sec1\" class=\"theme2\">
\t\t<div class=\"secondtheme\">
\t\t\t<div class=\"banner\"></div>
\t\t\t<div class=\"gotop p-5 pb-0\">
\t\t\t\t<div class=\"flx\">
\t\t\t\t\t<div class=\"cont\">
\t\t\t\t\t\t<div class=\"col-sm-3 \">
\t\t\t\t\t\t\t<img class=\"img-fluid float-end docimg\" src=\"";
            // line 61
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 61), "field_background_image", [], "any", false, false, true, 61), "url", [], "any", false, false, true, 61), 61, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 61), "field_background_image", [], "any", false, false, true, 61), "alt", [], "any", false, false, true, 61), 61, $this->source), "html", null, true);
            echo "\" width=\"100%\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"red_theme\">
\t\t\t\t\t\t<div class=\"box-cont d-flex\">
\t\t\t\t\t\t\t<div class=\"col-sm-10 box-data p-3\">
\t\t\t\t\t\t\t\t<h1 class=\"\">";
            // line 67
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 67), "field_name", [], "any", false, false, true, 67), 67, $this->source), "html", null, true);
            echo "</h1>
\t\t\t\t\t\t\t\t<p class=\"pt-3 col-sm-10\"><b>";
            // line 68
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 68), "field_speciality", [], "any", false, false, true, 68), 68, $this->source), "html", null, true);
            echo ", ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 68), "field_degree", [], "any", false, false, true, 68), 68, $this->source), "html", null, true);
            echo "</b>
\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t\t<p class=\"pt-3 fs-6  tc\">";
            // line 70
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 70), "field_phone_number", [], "any", false, false, true, 70), 70, $this->source), "html", null, true);
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 70), "field_email_address", [], "any", false, false, true, 70), 70, $this->source), "html", null, true);
            echo "</p>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<button class=\"btn appbtn p-2 mb-2 order-lg-2 order-sm-2\">Make an appointment</button>
\t\t\t\t\t\t\t\t<button class=\"whatsappbtn btn mb-2 \"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row p-4\">
\t\t\t\t\t<div class=\"col-sm-2\"></div>
\t\t\t\t\t<div class=\"col-sm-8\">
\t\t\t\t\t\t<div class=\"container\">
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t<p class=\"fs-2\"><span class=\"ten\"><b>";
            // line 85
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 85), "field_experiences", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
            echo " Years <span class=\"fs-6\">Experience</span></b></span></p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t<p class=\"fs-2\"><b><span class=\"ten\">";
            // line 88
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 88), "field_patients", [], "any", false, false, true, 88), 88, $this->source), "html", null, true);
            echo "</span> Patients</b></p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t<div class=\"rating float-start mb-3 mt-3 order-lg-2 order-sm-2\" id=\"rating\">
\t\t\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"1\">&#9733;</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"2\">&#9733;</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"3\">&#9733;</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"4\">&#9733;</span>
\t\t\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"5\">&#9733;</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            // line 99
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 99), "field_logos", [], "any", false, false, true, 99));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                // line 100
                echo "\t\t\t\t\t\t\t\t\t<div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"";
                // line 101
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 101), "url", [], "any", false, false, true, 101), 101, $this->source), "html", null, true);
                echo "\" alt=\"\" width=\"100%\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
";
        }
        // line 112
        echo "<section id=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 112) == "theme1")) ? ("sec2") : ("p2sec2")));
        echo "\" class=\"pt-5 pb-5 ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 112) == "theme1")) ? ("") : ("theme2")));
        echo "\">
\t\t";
        // line 113
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 113) == "theme2")) {
            // line 114
            echo "\t\t\t<div class=\"secondtheme\">
\t\t";
        }
        // line 116
        echo "\t<div class=\"container\">
\t\t<ul class=\"nav nav-pills \" role=\"tablist\">
\t\t";
        // line 118
        $context["k"] = 1;
        // line 119
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "tabs", [], "any", false, false, true, 119), "field_tab_section", [], "any", false, false, true, 119));
        foreach ($context['_seq'] as $context["key"] => $context["usertabdata"]) {
            // line 120
            echo "\t\t\t<li class=\"nav-item\">
\t\t\t\t<a class=\"nav-link ";
            // line 121
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["k"] ?? null) == 1)) ? ("active") : ("")));
            echo " fw-bold\" data-bs-toggle=\"pill\" href=\"#";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_tab_id", [], "any", false, false, true, 121), 121, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_tab_name", [], "any", false, false, true, 121), 121, $this->source), "html", null, true);
            echo "</a>
\t\t\t</li>
\t\t\t";
            // line 123
            $context["k"] = (($context["k"] ?? null) + 1);
            // line 124
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['usertabdata'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 125
        echo "\t\t</ul>
\t</div>
\t";
        // line 127
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 127) == "theme2")) {
            // line 128
            echo "\t\t</div>
\t";
        }
        // line 130
        echo "\t<div class=\"container\">
\t\t<div class=\"tab-content\">
\t\t";
        // line 132
        $context["i"] = 1;
        // line 133
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "tabs", [], "any", false, false, true, 133), "field_tab_section", [], "any", false, false, true, 133));
        foreach ($context['_seq'] as $context["key"] => $context["usertabdata"]) {
            // line 134
            echo "\t\t\t<div id=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_tab_id", [], "any", false, false, true, 134), 134, $this->source), "html", null, true);
            echo "\" class=\"container tab-pane ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["i"] ?? null) == 1)) ? ("active") : ("")));
            echo " pt-4\">
\t\t\t\t<br>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-lg-7 col-sm-7 pilltext\">
\t\t\t\t\t\t<p>";
            // line 138
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_description", [], "any", false, false, true, 138), 138, $this->source));
            echo "</p>
\t\t\t\t\t\t<br>
\t\t\t\t\t\t<p>";
            // line 140
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_name", [], "any", false, false, true, 140), 140, $this->source), "html", null, true);
            echo "</p>
\t\t\t\t\t\t<b>Education </b>
\t\t\t\t\t\t<p>";
            // line 142
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_education", [], "any", false, false, true, 142), 142, $this->source));
            echo "</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-lg-5 col-sm-5\">
\t\t\t\t\t\t<img class=\"img-fluid\" alt=\"";
            // line 145
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_background_image", [], "any", false, false, true, 145), "alt", [], "any", false, false, true, 145), 145, $this->source), "html", null, true);
            echo "\" src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["usertabdata"], "field_background_image", [], "any", false, false, true, 145), "url", [], "any", false, false, true, 145), 145, $this->source), "html", null, true);
            echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
            // line 149
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 150
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['usertabdata'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        echo "\t\t</div>
\t</div>
\t<div class=\"container mt-4\">
\t\t<div class=\"owl-carousel docslider\">
\t\t\t<img src=\"assets/img/video1.png\" class=\"img-fluid\" alt=\"...\">
\t\t\t<img src=\"assets/img/video2.png\" class=\"img-fluid\" alt=\"...\">
\t\t\t<img src=\"assets/img/video3.png\" class=\"img-fluid\" alt=\"...\">
\t\t\t<img src=\"assets/img/video1.png\" class=\"img-fluid\" alt=\"...\">
\t\t\t<img src=\"assets/img/video2.png\" class=\"img-fluid\" alt=\"...\">
\t\t</div>
\t</div>
</section>
<section id=\"";
        // line 163
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 163) == "theme1")) ? ("sec3") : ("p2sec3")));
        echo "\" class=\"p-5 pb-0\">
\t";
        // line 164
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 164) == "theme2")) {
            // line 165
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 167
        echo "\t\t<div class=\"container\">
\t\t\t<h2>Book Appointment</h2>
\t\t\t<ul class=\"nav nav-pills pt-3\" role=\"tablist\">
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link active fw-bold\" data-bs-toggle=\"pill\" href=\"#brain\">Advanced Brain Clinic </a>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#spine\">Spine Surgical Clinic</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#medical\">Gleneagles Medical Centre Clinic</a>
\t\t\t\t</li>
\t\t\t</ul>
\t\t\t<div id=\"brain\" class=\"container tab-pane active\">
\t\t\t\t<br>
\t\t\t\t<div class=\"col-lg-8 col-sm-12 pt-4\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"owl-carousel dateslider\">
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">MON</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">16</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Tue</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">17</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Wed</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">18</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Thu</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">19</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Fri</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">20</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Sat</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">21</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Sun</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">22</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Mon</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">23</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"date-wrapper\">
\t\t\t\t\t\t\t\t<div class=\"day text-center\">Tue</div>
\t\t\t\t\t\t\t\t<div class=\"date text-center\">24</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row pt-5\">
\t\t\t\t\t<div class=\"col-sm-1 col-lg- \">
\t\t\t\t\t\t<img src=\"assets/img/loc.png\" class=\"loc-icon d-block mx-auto\" alt=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-5 pt-1\">
\t\t\t\t\t\t<p class=\"loctext fw-bold fs-5\">Clinic One <br><span>51 Goldhill Plaza #19-10/12 Banglore 308900</span></p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t<div class=\"fs-3 pt-5\"><b>Morning (5 slots)</b></div>
\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>9AM - 12 noon </b> <span class=\"text-danger\">No Slot Available</span></button>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t<div class=\"fs-3 pt-5\"><b>After Noon </b></div>
\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>12 noon - 5PM </b> <span class=\"text-danger\">Doctor On Leave</span></button>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"fs-3 pt-5\"><b>Evening (5 slots) </b></div>
\t\t\t\t\t<div class=\"sm-4\">
\t\t\t\t\t\t<ul class=\"time-wrap\">
\t\t\t\t\t\t\t<li class=\"time\">
\t\t\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>4:00 PM</b></button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li class=\"time\">
\t\t\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>4:30 PM</b></button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li class=\"time\">
\t\t\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>5:00 PM</b></button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li class=\"time\">
\t\t\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>4:30 PM</b></button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li class=\"time\">
\t\t\t\t\t\t\t\t<button class=\"ap-book p-3 mt-2\"><b>2:00 PM</b></button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div id=\"spine\" class=\"container tab-pane fade\">
\t\t\t\t<br>
\t\t\t\t<div class=\"col-sm-7\">
\t\t\t\t\t<h3>Spine</h3>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div id=\"medical\" class=\"container tab-pane fade\">
\t\t\t\t<br>
\t\t\t\t<div class=\"col-sm-7\">
\t\t\t\t\t<h3>Medical</h3>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t";
        // line 276
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 276) == "theme2")) {
            // line 277
            echo "\t\t</div>
\t";
        }
        // line 279
        echo "</section>
<section id=\"";
        // line 280
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 280) == "theme1")) ? ("sec4") : ("p2sec4")));
        echo "\" class=\"pt-0\">
\t";
        // line 281
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 281) == "theme2")) {
            // line 282
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 284
        echo "\t<div class=\"container\">
\t\t<div class=\"row p-2\">
\t\t\t<h2 class=\"col-lg-9\">Areas of expertise</h2>
\t\t\t<button class=\"btn mx-end col-lg-3 facilities\">View All Speciality Facilities</button>
\t\t</div>
\t\t<div class=\"row pt-5\">
\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t<img src=\"assets/img/exp1.png\" width=\"100%\">
\t\t\t\t</div>
\t\t\t\t<h6 class=\"text-center p-3\"><b>Neurological treatments</b></h6>
\t\t\t\t<div class=\"text-center\">
\t\t\t\t\tNeurosurgeons, like Neurologists,
\t\t\t\t\ttreat a variety of diseases. People
\t\t\t\t\twho visit neurosurgeons are
\t\t\t\t\tfrequently those who have been
\t\t\t\t\trecommended to do so by
\t\t\t\t\tneurologists
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t<img src=\"assets/img/exp2.png\" width=\"100%\">
\t\t\t\t</div>
\t\t\t\t<h6 class=\"text-center p-3\"><b>Neurological treatments</b></h6>
\t\t\t\t<div class=\"text-center\">
\t\t\t\t\tNeurosurgeons, like Neurologists,
\t\t\t\t\ttreat a variety of diseases. People
\t\t\t\t\twho visit neurosurgeons are
\t\t\t\t\tfrequently those who have been
\t\t\t\t\trecommended to do so by
\t\t\t\t\tneurologists
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t<img src=\"assets/img/exp3.png\" width=\"100%\">
\t\t\t\t</div>
\t\t\t\t<h6 class=\"text-center p-3\"><b>Neurological treatments</b></h6>
\t\t\t\t<div class=\"text-center\">
\t\t\t\t\tNeurosurgeons, like Neurologists,
\t\t\t\t\ttreat a variety of diseases. People
\t\t\t\t\twho visit neurosurgeons are
\t\t\t\t\tfrequently those who have been
\t\t\t\t\trecommended to do so by
\t\t\t\t\tneurologists
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t<img src=\"assets/img/exp4.png\" width=\"100%\">
\t\t\t\t</div>
\t\t\t\t<h6 class=\"text-center p-3\"><b>Neurological treatments</b></h6>
\t\t\t\t<div class=\"text-center\">
\t\t\t\t\tNeurosurgeons, like Neurologists,
\t\t\t\t\ttreat a variety of diseases. People
\t\t\t\t\twho visit neurosurgeons are
\t\t\t\t\tfrequently those who have been
\t\t\t\t\trecommended to do so by
\t\t\t\t\tneurologists
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t<img src=\"assets/img/exp5.png\" width=\"100%\">
\t\t\t\t</div>
\t\t\t\t<h6 class=\"text-center p-3\"><b>Neurological treatments</b></h6>
\t\t\t\t<div class=\"text-center\">
\t\t\t\t\tNeurosurgeons, like Neurologists,
\t\t\t\t\ttreat a variety of diseases. People
\t\t\t\t\twho visit neurosurgeons are
\t\t\t\t\tfrequently those who have been
\t\t\t\t\trecommended to do so by
\t\t\t\t\tneurologists
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-4 col-md-6  col-sm-4 p-5\">
\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t<img src=\"assets/img/exp6.png\" width=\"100%\">
\t\t\t\t</div>
\t\t\t\t<h6 class=\"text-center p-3\"><b>Neurological treatments</b></h6>
\t\t\t\t<div class=\"text-center\">
\t\t\t\t\tNeurosurgeons, like Neurologists,
\t\t\t\t\ttreat a variety of diseases. People
\t\t\t\t\twho visit neurosurgeons are
\t\t\t\t\tfrequently those who have been
\t\t\t\t\trecommended to do so by
\t\t\t\t\tneurologists
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 376
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 376) == "theme2")) {
            // line 377
            echo "\t\t</div>
\t";
        }
        // line 379
        echo "</section>
<section id=\"";
        // line 380
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 380) == "theme1")) ? ("sec5") : ("p2sec5")));
        echo "\" class=\"\">
\t";
        // line 381
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 381) == "theme2")) {
            // line 382
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 384
        echo "\t<h2 class=\"text-center\">Latest News & Articles</h2>
\t<div class=\"container\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-sm-12 search-wrapper p-3\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-12 col-md-12\">
\t\t\t\t\t\t<div class=\"d-flex\">
\t\t\t\t\t\t\t<input class=\"form-control flex-grow-1 p-3\" type=\"search\" name=\"search\" id=\"search\" placeholder=\"Search for news\">
\t\t\t\t\t\t\t<button class=\"searchBtn p-3 ml-2 search_news_btn\">Search</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-sm-12 col-md-12 mt-3 mt-md-0\">
\t\t\t\t\t\t<div class=\"tags text-white d-flex flex-wrap\">
\t\t\t\t\t\t\t<p class=\"mx-2 my-1 cat-news-load\" data-id=\"\">All</p>
\t\t\t\t\t\t\t";
        // line 398
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "news_categoery", [], "any", false, false, true, 398));
        foreach ($context['_seq'] as $context["key"] => $context["categorey"]) {
            // line 399
            echo "\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1 cat-news-load\" data-id=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["categorey"], "term_id", [], "any", false, false, true, 399), 399, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["categorey"], "term_name", [], "any", false, false, true, 399), 399, $this->source), "html", null, true);
            echo " </p>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['categorey'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 401
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"news_cls\">
\t\t\t\t<h5 class=\"p-3\">";
        // line 406
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "node_count", [], "any", false, false, true, 406), 406, $this->source), "html", null, true);
        echo " Results</h5>
\t\t\t\t";
        // line 407
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "article", [], "any", false, false, true, 407));
        foreach ($context['_seq'] as $context["key"] => $context["news_article"]) {
            // line 408
            echo "\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"";
            // line 410
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "thumb", [], "any", false, false, true, 410), 410, $this->source), "html", null, true);
            echo "\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By ";
            // line 412
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "author", [], "any", false, false, true, 412), 412, $this->source), "html", null, true);
            echo " </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">";
            // line 413
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "date", [], "any", false, false, true, 413), 413, $this->source), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>";
            // line 416
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "title", [], "any", false, false, true, 416), 416, $this->source), "html", null, true);
            echo "</b></h6>
\t\t\t\t\t\t\t\t<div>";
            // line 417
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "body", [], "any", false, false, true, 417), 417, $this->source));
            echo "
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['news_article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 424
        echo "\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 427
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 427) == "theme2")) {
            // line 428
            echo "\t\t</div>
\t";
        }
        // line 430
        echo "</section>
<section id=\"";
        // line 431
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 431) == "theme1")) ? ("sec6") : ("p2sec6")));
        echo "\" class=\"p-2\">
\t";
        // line 432
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 432) == "theme2")) {
            // line 433
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 435
        echo "\t<div class=\"container\">
\t\t<p class=\"text-center fs-5 pt-5\">Patient Experience</p>
\t\t<h2 class=\"text-center pb-4\">What patients say about the doctor</h2>
\t\t<div class=\"col-sm-12 border border-dark-subtle rounded p-4\">
\t\t\t<div class=\"row\">
\t\t\t\t<input type=\"search\" class=\"p-3 col-sm-9\" placeholder=\"Patient Experience\">
\t\t\t\t<div class=\"col-sm-3 d-flex\">
\t\t\t\t\t<span class=\"pt-3\">Sort By: </span>
\t\t\t\t\t<div class=\"dropdown mx-2\">
\t\t\t\t\t\t<button type=\"button\" class=\"btn p-3 dropdown-toggle border border-dark-subtle\" data-bs-toggle=\"dropdown\">
\t\t\t\t\t\tMost Recent
\t\t\t\t\t\t</button>
\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\">Normal</a></li>
\t\t\t\t\t\t\t<li><a class=\"dropdown-item active\" href=\"#\">Active</a></li>
\t\t\t\t\t\t\t<li><a class=\"dropdown-item disabled\" href=\"#\">Disabled</a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"row\">
\t\t\t<div class=\"col-sm-12 border border-dark-subtle rounded mt-5 pb-3 pt-3\">
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Patient Experiences</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy </button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\"> cancer and tumors</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\"> craniosynostosis</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Reviews </button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks </button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"row \">
\t\t\t<div class=\"col-sm-6 p-4\">
\t\t\t\t<div class=\"test-wrapp\">
\t\t\t\t\t<div class=\"p-3\">
\t\t\t\t\t\t<div class=\"quotes\">\"</div>
\t\t\t\t\t\t<b>I visited Neurological treatments</b><br>
\t\t\t\t\t\tAliquam fringilla nibh nec erat rhoncus, at sodales orci
\t\t\t\t\t\tmattis. Vestibulu ante ipsum primis in faucibus orci
\t\t\t\t\t\tluctus et ultrices posuere cubilia erp curae Cras
\t\t\t\t\t\tvolutpat fermentum ligula.
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t<img src=\"assets/img/testimonial1.png\" class=\"pt-2 img-fluid d-block mx-auto\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-6 pt-2\">
\t\t\t\t\t\t\t\t<div class=\"fw-bolder\">Weston R. James</div>
\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Aneurysm</button>
\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Hedeche</button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-sm-6 p-4\">
\t\t\t\t<div class=\"test-wrapp\">
\t\t\t\t\t<div class=\"p-3\">
\t\t\t\t\t\t<div class=\"quotes\">\"</div>
\t\t\t\t\t\t<b>I visited Numbness </b><br>
\t\t\t\t\t\tAliquam fringilla nibh nec erat rhoncus, at sodales orci
\t\t\t\t\t\tmattis. Vestibulu ante ipsum primis in faucibus orci
\t\t\t\t\t\tluctus et ultrices posuere cubilia erp curae Cras
\t\t\t\t\t\tvolutpat fermentum ligula.
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t<img src=\"assets/img/testimonial2.png\" class=\"pt-2 img-fluid d-block mx-auto\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-6 pt-2\">
\t\t\t\t\t\t\t\t<div class=\"fw-bolder\">Weston R. James</div>
\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Aneurysm</button>
\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Hedeche</button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 517
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 517) == "theme2")) {
            // line 518
            echo "\t\t</div>
\t";
        }
        // line 520
        echo "</section>
<section id=\"";
        // line 521
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 521) == "theme1")) ? ("sec7") : ("p2sec7")));
        echo "\" class=\"pt-5 pb-5\">
\t";
        // line 522
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 522) == "theme2")) {
            // line 523
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 525
        echo "\t<div class=\"container\">
\t\t<h2 class=\"text-center pb-5\">Frequently Asked Questions</h2>
\t\t<div class=\"col-sm-12 border border-dark-subtle rounded p-4\">
\t\t\t<div class=\"row\">
\t\t\t\t<input type=\"search\" class=\"p-3 col-sm-9\" placeholder=\"Search For Answers\">
\t\t\t\t<div class=\"col-sm-3 d-flex\">
\t\t\t\t\t<span class=\"pt-3\">Sort By: </span>
\t\t\t\t\t<div class=\"dropdown mx-2\">
\t\t\t\t\t\t<button type=\"button\" class=\"btn p-3 dropdown-toggle border border-dark-subtle\" data-bs-toggle=\"dropdown\">
\t\t\t\t\t\tMost Recent
\t\t\t\t\t\t</button>
\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\">Normal</a></li>
\t\t\t\t\t\t\t<li><a class=\"dropdown-item active\" href=\"#\">Active</a></li>
\t\t\t\t\t\t\t<li><a class=\"dropdown-item disabled\" href=\"#\">Disabled</a></li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-sm-12 border border-dark-subtle rounded p-3 mt-5\">
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Patient Experiences</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks </button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Reviews</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
\t\t</div>
\t</div>
\t";
        // line 558
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 558) == "theme2")) {
            // line 559
            echo "\t\t</div>
\t";
        }
        // line 561
        echo "</section>
<div class=\"pt-3\">
\t<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15555.80884571165!2d77.59631594999999!3d12.91079305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1712128342123!5m2!1sen!2sin\" class=\"map\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>
</div>
<script src=\"assets/js/main.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js\"></script>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["arr_data"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "modules/custom/userprofile/templates/profile-custom-template.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  860 => 561,  856 => 559,  854 => 558,  819 => 525,  815 => 523,  813 => 522,  809 => 521,  806 => 520,  802 => 518,  800 => 517,  716 => 435,  712 => 433,  710 => 432,  706 => 431,  703 => 430,  699 => 428,  697 => 427,  692 => 424,  679 => 417,  675 => 416,  669 => 413,  665 => 412,  660 => 410,  656 => 408,  652 => 407,  648 => 406,  641 => 401,  630 => 399,  626 => 398,  610 => 384,  606 => 382,  604 => 381,  600 => 380,  597 => 379,  593 => 377,  591 => 376,  497 => 284,  493 => 282,  491 => 281,  487 => 280,  484 => 279,  480 => 277,  478 => 276,  367 => 167,  363 => 165,  361 => 164,  357 => 163,  343 => 151,  337 => 150,  335 => 149,  326 => 145,  320 => 142,  315 => 140,  310 => 138,  300 => 134,  295 => 133,  293 => 132,  289 => 130,  285 => 128,  283 => 127,  279 => 125,  273 => 124,  271 => 123,  262 => 121,  259 => 120,  254 => 119,  252 => 118,  248 => 116,  244 => 114,  242 => 113,  235 => 112,  225 => 104,  216 => 101,  213 => 100,  209 => 99,  195 => 88,  189 => 85,  169 => 70,  162 => 68,  158 => 67,  147 => 61,  138 => 54,  129 => 47,  120 => 44,  117 => 43,  113 => 42,  107 => 39,  102 => 37,  86 => 26,  73 => 18,  68 => 16,  64 => 15,  60 => 14,  47 => 6,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/userprofile/templates/profile-custom-template.html.twig", "C:\\xampp\\htdocs\\linqmd\\modules\\custom\\userprofile\\templates\\profile-custom-template.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "for" => 42, "set" => 118);
        static $filters = array("escape" => 6, "raw" => 138);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 'raw'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
