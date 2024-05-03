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
    <div class=\"container\">
        <div class=\"row\">


            <div class=\"col-lg-5 mx-auto col-md-5 order-lg-2 order-sm-2 img-bg p-5\">

                <img src=\"";
            // line 9
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 9), "field_background_image", [], "any", false, false, true, 9), "url", [], "any", false, false, true, 9), 9, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 9), "field_background_image", [], "any", false, false, true, 9), "alt", [], "any", false, false, true, 9), 9, $this->source), "html", null, true);
            echo "\">

            </div>

            <div class=\"svg d-block d-sm-none\">
                <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\">
                    <path fill=\"#4c94d3\" fill-opacity=\"1\" d=\"M0,128L80,144C160,160,320,192,480,197.3C640,203,800,181,960,149.3C1120,117,1280,75,1360,53.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z\"></path>
                </svg>
            </div>

            <div class=\"col-lg-7 col-md-7 intro-box order-lg-1 order-sm-1\">
                <h1 class=\"fs-1 tc\">";
            // line 20
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 20), "field_name", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
            echo "</h1>
                <p class=\"title tc\">";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 21), "field_speciality", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo " </p>
                <p style=\"margin-top: -10px;\" class=\"tc\">";
            // line 22
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 22), "field_degree", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo " </p>
                <div class=\"d-block d-sm-none\" style=\"margin-top: -20px;\">
                    <p class=\"pt-4 fs-4 m-3 tc\">";
            // line 24
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 24), "field_phone_number", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 24), "field_email_address", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            echo "</p>
                </div>
                <div class=\"row\">
                    <div class=\"col-sm-7 bg-change\">
                        <div class=\"sm-fl\">

                            <button class=\"btn appbtn rounded-pill mb-2 order-lg-2 order-sm-2\">Book an appointment</button>

                            <a href=\"https://api.whatsapp.com/send?phone=";
            // line 32
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 32), "field_phone_number", [], "any", false, false, true, 32), 32, $this->source), "html", null, true);
            echo "&text=Hello.\" target=\"_blank\"><button class=\"whatsappbtn btn mb-2 d-block d-sm-none\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button></a>

                        </div>
                        <p class=\"pt-4 fs-6 mb-4 d-none d-sm-block\">";
            // line 35
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 35), "field_phone_number", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
            echo " <br>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 35), "field_email_address", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
            echo "</p>
                        <div class=\"rating float-start mb-3 mt-3 order-lg-2 order-sm-2\" id=\"rating\">
                            ";
            // line 37
            $context["value"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 37), "field_profilerating", [], "any", false, false, true, 37);
            // line 38
            echo "                            ";
            $context["wholeStars"] = twig_round($this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 38, $this->source), 0, "floor");
            // line 39
            echo "                            ";
            $context["remainder"] = (($context["value"] ?? null) - ($context["wholeStars"] ?? null));
            // line 40
            echo "
                            ";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 42
                echo "                            ";
                if (($context["i"] <= ($context["wholeStars"] ?? null))) {
                    // line 43
                    echo "                            <span class=\"star filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 43, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
                            ";
                } elseif (((                // line 44
$context["i"] == (($context["wholeStars"] ?? null) + 1)) && (($context["remainder"] ?? null) > 0))) {
                    // line 45
                    echo "                            <span class=\"star half-filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 45, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
                            ";
                } else {
                    // line 47
                    echo "                            <span class=\"star\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 47, $this->source), "html", null, true);
                    echo "\">&#9734;</span>
                            ";
                }
                // line 49
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "                        </div>
                    </div>
                    <div class=\"col-sm-5 d-none d-sm-block\">

                        <a href=\"https://api.whatsapp.com/send?phone=";
            // line 54
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 54), "field_phone_number", [], "any", false, false, true, 54), 54, $this->source), "html", null, true);
            echo "&text=Hello.\" target=\"_blank\">
                            <button class=\"whatsappbtn btn mb-2\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button>
                        </a>

                        <p class=\"exp mt-3 col-10\">";
            // line 58
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 58), "field_experiences", [], "any", false, false, true, 58), 58, $this->source), "html", null, true);
            echo "</p>
                       
                        <p class=\"exp mb-4 col-10\">";
            // line 60
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 60), "field_patients", [], "any", false, false, true, 60), 60, $this->source), "html", null, true);
            echo "</p>
                    </div>
                    <div class=\"col-sm-12\">
                        <div class=\"bg-change row\">

                            ";
            // line 65
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 65), "field_logos", [], "any", false, false, true, 65));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                // line 66
                echo "                            <div class=\"col-sm-4 m-2 clinic-wrap\">
                                <img class=\"img-fluid mx-auto d-block\" src=\"";
                // line 67
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 67), "url", [], "any", false, false, true, 67), 67, $this->source), "html", null, true);
                echo "\" alt=\"\">
                            </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo "

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>







";
        } else {
            // line 89
            echo "
    <section id=\"p2sec1\">
        <div class=\"secondtheme\">
            <div class=\"banner\">
                <img src=\"";
            // line 93
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 93), "field_displaypicture", [], "any", false, false, true, 93), "url", [], "any", false, false, true, 93), 93, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 93), "field_displaypicture", [], "any", false, false, true, 93), "alt", [], "any", false, false, true, 93), 93, $this->source), "html", null, true);
            echo "\" >

                <div class=\"container d-none d-sm-block\">
                    <div class=\"row profile-wrapper\">
                        <div class=\"circle-container\">
                            <img src=\"";
            // line 98
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 98), "field_background_image", [], "any", false, false, true, 98), "url", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 98), "field_background_image", [], "any", false, false, true, 98), "alt", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "\">
                        </div>
                        <div class=\"col-sm-8 content-wrapper\">
                            <div class=\"d-flex\">
                                <div class=\"col-8 mx-3\">
                                    <h1 class=\"fon1 pt-4\">";
            // line 103
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 103), "field_name", [], "any", false, false, true, 103), 103, $this->source), "html", null, true);
            echo "</h1>
                                    <p>";
            // line 104
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 104), "field_allcertifications", [], "any", false, false, true, 104), 104, $this->source), "html", null, true);
            echo "<br>
                                       
                                    </p>
                                    <p>
                                        ";
            // line 108
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 108), "field_phone_number", [], "any", false, false, true, 108), 108, $this->source), "html", null, true);
            echo " | ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 108), "field_email_address", [], "any", false, false, true, 108), 108, $this->source), "html", null, true);
            echo "
                                    </p>
                                </div>
                                <div class=\"col-4\">
                                    <button class=\"btn appbtn float-end\">Book an appointment</button>
                                    <a href=\"https://api.whatsapp.com/send?phone=";
            // line 113
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 113), "field_phone_number", [], "any", false, false, true, 113), 113, $this->source), "html", null, true);
            echo "&text=Hello.\" target=\"_blank\"><button class=\"whatsappbtn btn  float-end\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--            small device  -->

                <div class=\"d-block d-sm-none\">
                    <div class=\"small-profileWrapper p-5\">
                        <div class=\"circle-container mx-auto\">
                            <img src=\"";
            // line 126
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 126), "field_background_image", [], "any", false, false, true, 126), "url", [], "any", false, false, true, 126), 126, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 126), "field_background_image", [], "any", false, false, true, 126), "alt", [], "any", false, false, true, 126), 126, $this->source), "html", null, true);
            echo "\">
                        </div>
                        <h1 class=\"fon1 pt-4 text-center\">";
            // line 128
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 128), "field_name", [], "any", false, false, true, 128), 128, $this->source), "html", null, true);
            echo "</h1>
                        <p class=\"text-center\">";
            // line 129
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 129), "field_allcertifications", [], "any", false, false, true, 129), 129, $this->source), "html", null, true);
            echo "<br>
                            ";
            // line 130
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 130), "field_allcertifications", [], "any", false, false, true, 130), 130, $this->source), "html", null, true);
            echo "
                        </p>
                        <p class=\"text-center\">
                             ";
            // line 133
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 133), "field_phone_number", [], "any", false, false, true, 133), 133, $this->source), "html", null, true);
            echo " | ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 133), "field_email_address", [], "any", false, false, true, 133), 133, $this->source), "html", null, true);
            echo "
                        </p>
                    </div>
                    <button class=\"btn appbtn mx-auto d-block\">Book an appointment</button>
                    <a href=\"https://api.whatsapp.com/send?phone=";
            // line 137
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 137), "field_phone_number", [], "any", false, false, true, 137), 137, $this->source), "html", null, true);
            echo "&text=Hello.\" target=\"_blank\"><button class=\"whatsappbtn btn mx-auto d-block\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button></a>

                    <div class=\"col-lg-4 fs-3 fw-bold\">
                        <div class=\" rating  mb-3 mt-3 text-center\" id=\"rating\">
                            ";
            // line 141
            $context["value"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 141), "field_profilerating", [], "any", false, false, true, 141);
            // line 142
            echo "                            ";
            $context["wholeStars"] = twig_round($this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 142, $this->source), 0, "floor");
            // line 143
            echo "                            ";
            $context["remainder"] = (($context["value"] ?? null) - ($context["wholeStars"] ?? null));
            // line 144
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 145
                echo "                                ";
                if (($context["i"] <= ($context["wholeStars"] ?? null))) {
                    // line 146
                    echo "                                <span class=\"star filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 146, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
                                    ";
                } elseif (((                // line 147
$context["i"] == (($context["wholeStars"] ?? null) + 1)) && (($context["remainder"] ?? null) > 0))) {
                    // line 148
                    echo "                                    <span class=\"star half-filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 148, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
                                    ";
                } else {
                    // line 150
                    echo "                                <span class=\"star\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 150, $this->source), "html", null, true);
                    echo "\">&#9734;</span>
                                ";
                }
                // line 152
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 153
            echo "                        </div>

                    </div>
                    <div class=\"d-flex\">
                        ";
            // line 157
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 157), "field_logos", [], "any", false, false, true, 157));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                // line 158
                echo "                            <div class=\" mx-auto d-block col-sm-4 m-2 clinic-wrap\">
                                <img class=\"img-fluid mx-auto d-block\" src=\"";
                // line 159
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 159), "url", [], "any", false, false, true, 159), 159, $this->source), "html", null, true);
                echo "\" alt=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 159), "alt", [], "any", false, false, true, 159), 159, $this->source), "html", null, true);
                echo "\">
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 161
            echo "   
                       
                    </div>
                    <div class=\"col-lg-4 col-sm-6 text-center fs-3 fw-bold\">
                        ";
            // line 165
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 165), "field_experiences", [], "any", false, false, true, 165), 165, $this->source), "html", null, true);
            echo "
                    </div>

                    <div class=\"col-lg-4 col-sm-6 text-center fs-3 fw-bold\">
                        ";
            // line 169
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 169), "field_patients", [], "any", false, false, true, 169), 169, $this->source), "html", null, true);
            echo "
                    </div>

                </div>
                
                <!--            small device end -->
                
            </div>


            <div class=\"container heightallignment d-none d-sm-block\">
                <div class=\"row\">
                    <div class=\"offset-lg-2 col-10 row\">
                        <div class=\"col-lg-4 col-sm-6 text-center fs-5 fw-bold\">
                              ";
            // line 183
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 183), "field_experiences", [], "any", false, false, true, 183), 183, $this->source), "html", null, true);
            echo "
                        </div>

                        <div class=\"col-lg-4 col-sm-6 text-center fs-5 fw-bold\">
                               ";
            // line 187
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 187), "field_patients", [], "any", false, false, true, 187), 187, $this->source), "html", null, true);
            echo "
                        </div>

                        <div class=\"col-lg-4 fs-3 fw-bold \">
                            <div class=\"rating float-start mb-3 mt-3 order-lg-2 order-sm-2\" id=\"rating\">
                            ";
            // line 192
            $context["value"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 192), "field_profilerating", [], "any", false, false, true, 192);
            // line 193
            echo "                            ";
            $context["wholeStars"] = twig_round($this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 193, $this->source), 0, "floor");
            // line 194
            echo "                            ";
            $context["remainder"] = (($context["value"] ?? null) - ($context["wholeStars"] ?? null));
            // line 195
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 196
                echo "                                ";
                if (($context["i"] <= ($context["wholeStars"] ?? null))) {
                    // line 197
                    echo "                                <span class=\"star filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 197, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
                                    ";
                } elseif (((                // line 198
$context["i"] == (($context["wholeStars"] ?? null) + 1)) && (($context["remainder"] ?? null) > 0))) {
                    // line 199
                    echo "                                    <span class=\"star half-filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 199, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
                                    ";
                } else {
                    // line 201
                    echo "                                <span class=\"star\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 201, $this->source), "html", null, true);
                    echo "\">&#9734;</span>
                                ";
                }
                // line 203
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 204
            echo "                            </div>

                        </div>
                    ";
            // line 207
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 207), "field_logos", [], "any", false, false, true, 207));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                // line 208
                echo "                        <div class=\" mx-auto d-block col-sm-4 m-2 clinic-wrap\">
                            <img class=\"img-fluid mx-auto d-block\" src=\"";
                // line 209
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 209), "url", [], "any", false, false, true, 209), 209, $this->source), "html", null, true);
                echo "\" alt=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 209), "alt", [], "any", false, false, true, 209), 209, $this->source), "html", null, true);
                echo "\">
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 211
            echo "     

                    </div>
                </div>

            </div>
        </div>
    </section>


";
        }
        // line 222
        echo "





<section id=\"";
        // line 228
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 228) == "theme1")) ? ("sec2") : ("p2sec2")));
        echo "\" class=\"pt-5 pb-5 ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 228) == "theme1")) ? ("") : ("theme2")));
        echo "\">

\t\t";
        // line 230
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 230) == "theme2")) {
            // line 231
            echo "\t\t\t<div class=\"secondtheme\">
\t\t";
        }
        // line 233
        echo "    <div class=\"container\">
        <ul class=\"nav nav-pills \" role=\"tablist\">
            <li class=\"nav-item\">
                <a class=\"nav-link active fw-bold\" data-bs-toggle=\"pill\" href=\"#overview\">Overview</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#speciality\">Speciality</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#summary\">Expertise summary</a>
            </li>
           
        </ul>
    </div>

    <div class=\"container\">
        <div class=\"tab-content\">

            <div id=\"overview\" class=\"container tab-pane active pt-4\"><br>
                <div class=\"row\">
                    <div class=\"col-lg-7 col-sm-7 pilltext\">
                        <p>";
        // line 254
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 254), "field_overview", [], "any", false, false, true, 254), 254, $this->source), "html", null, true);
        echo "</p>
                        <br>
                        <h2><b>Education</b></h2>
                        <p>";
        // line 257
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 257), "field_allcertifications", [], "any", false, false, true, 257), 257, $this->source), "html", null, true);
        echo "</p>
                    </div>
                    <div class=\"col-lg-5 col-sm-5 \">
                         <iframe width=\"100%\" height=\"100%\" src=\"";
        // line 260
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 260), "field_doctoroverviewvideo", [], "any", false, false, true, 260), 260, $this->source), "html", null, true);
        echo "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>
                    </div>
                </div>

            </div>

            <div id=\"speciality\" class=\"container tab-pane fade pt-4\"><br>
                <div class=\"row\">
                    <div class=\"col-lg-7 col-sm-7 pilltext\">
                        <p>";
        // line 269
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 269), "field_specialities", [], "any", false, false, true, 269), 269, $this->source), "html", null, true);
        echo "</p>
                        <br>
                    </div>
                    <div class=\"col-lg-5 col-sm-5\">
                        ";
        // line 273
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 273), "field_youtube", [], "any", false, false, true, 273));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["key"] => $context["url"]) {
            // line 274
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 274) == 3)) {
                // line 275
                echo "                        <iframe width=\"100%\" height=\"100%\" src=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["url"], "field_youtube_embede", [], "any", false, false, true, 275), 275, $this->source), "html", null, true);
                echo "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>
                        ";
            }
            // line 277
            echo "                        ";
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
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['url'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 278
        echo "
                    </div>
                </div>
            </div>

            <div id=\"summary\" class=\"container tab-pane fade pt-4\"><br>
                <div class=\"row\">
                    <div class=\"col-lg-12 pilltext\">
                        <p>";
        // line 286
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 286), "field_expertise_summary", [], "any", false, false, true, 286), 286, $this->source), "html", null, true);
        echo "</p>                        
                    </div>
                    <div class=\"col-lg-5 col-sm-5\">



                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class=\"container mt-4\">
        <div class=\"owl-carousel docslider \">
            ";
        // line 302
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 302), "field_youtube", [], "any", false, false, true, 302));
        foreach ($context['_seq'] as $context["key"] => $context["url"]) {
            // line 303
            echo "            <iframe class=\"p-3 mx-auto d-block\" width=\"80%\" src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["url"], "field_youtube_embede", [], "any", false, false, true, 303), 303, $this->source), "html", null, true);
            echo "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['url'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 305
        echo "        </div>
    </div>

\t";
        // line 308
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 308) == "theme2")) {
            // line 309
            echo "\t\t</div>
\t";
        }
        // line 311
        echo "
</section>


<section id=\"";
        // line 315
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 315) == "theme1")) ? ("sec3") : ("p2sec3")));
        echo "\" class=\"p-5 pb-3\">
\t";
        // line 316
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 316) == "theme2")) {
            // line 317
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 319
        echo "

    <div class=\"container\">
    <h2>Book Appointment</h2>
    <ul class=\"nav nav-pills\">
        ";
        // line 324
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 324), "field_logos", [], "any", false, false, true, 324));
        foreach ($context['_seq'] as $context["k"] => $context["clinic"]) {
            // line 325
            echo "            ";
            if (($context["k"] == "0")) {
                // line 326
                echo "                <li class=\"nav-item\">
                    <a class=\"nav-link active\" data-bs-toggle=\"pill\" href=\"#";
                // line 327
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["k"], 327, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["clinic"], "field_clinicname", [], "any", false, false, true, 327), 327, $this->source), "html", null, true);
                echo "</a>
                </li>
            ";
            } else {
                // line 330
                echo "                <li class=\"nav-item\">
                    <a class=\"nav-link\" data-bs-toggle=\"pill\" href=\"#";
                // line 331
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["k"], 331, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["clinic"], "field_clinicname", [], "any", false, false, true, 331), 331, $this->source), "html", null, true);
                echo "</a>
                </li>
            ";
            }
            // line 334
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['clinic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 335
        echo "    </ul>


            <div class=\"tab-content\">
                <div id=\"0\" class=\" tab-pane active\"><br>
                    <div id=\"brain\" class=\" tab-pane active\"><br>
                        <div class=\"col-lg-8 col-sm-12 pt-4\">
                            <div class=\"row\">

                                <div class=\"owl-carousel dateslider\">
                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">MON</div>
                                        <div class=\"date text-center\">16</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Tue</div>
                                        <div class=\"date text-center\">17</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Wed</div>
                                        <div class=\"date text-center\">18</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Thu</div>
                                        <div class=\"date text-center\">19</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Fri</div>
                                        <div class=\"date text-center\">20</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Sat</div>
                                        <div class=\"date text-center\">21</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Sun</div>
                                        <div class=\"date text-center\">22</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Mon</div>
                                        <div class=\"date text-center\">23</div>
                                    </div>

                                    <div class=\"date-wrapper\">
                                        <div class=\"day text-center\">Tue</div>
                                        <div class=\"date text-center\">24</div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class=\"d-flex sm-block\">
                            <div class=\"col-sm-1 pt-3\">
                                <div class=\"location-wrapper\">
                                    <p class=\"text-center p-2 pt-2 fs-1\"><i class=\"fa-solid fa-location-dot \"></i></p>
                                </div>
                            </div>
                            ";
        // line 401
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, true, true, 401), "field_logos", [], "any", true, true, true, 401) && (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 401), "field_logos", [], "any", false, false, true, 401)) > 0))) {
            // line 402
            echo "                            ";
            $context["Clinic"] = (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 402), "field_logos", [], "any", false, false, true, 402)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[0] ?? null) : null);
            // line 403
            echo "                                <div class=\"col-lg-8  pt-1\">
                                    <p class=\"fw-400 fs-5\">Clinic one <br><span>";
            // line 404
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["Clinic"] ?? null), "field_address", [], "any", false, false, true, 404), 404, $this->source), "html", null, true);
            echo "</span></p>
                                </div>
                            ";
        }
        // line 407
        echo "                        </div>

                        <div class=\"row\">

                            <div class=\"col-sm-12\">
                                <div class=\"fs-3 pt-5\"><b>Morning (5 slots)</b></div>
                                <button class=\"ap-book p-3 mt-2\"><b>9AM - 12 noon </b> <span class=\"text-danger\">No Slot Available</span></button>
                            </div>

                            <div class=\"col-sm-12\">
                                <div class=\"fs-3 pt-5\"><b>After Noon </b></div>
                                <button class=\"ap-book p-3 mt-2\"><b>12 noon - 5PM </b> <span class=\"text-danger\">Doctor On Leave</span></button>
                            </div>

                            <div class=\"fs-3 pt-5\"><b>Evening (5 slots) </b></div>
                            <div class=\"sm-4\">


                                <ul class=\"time-wrap\">
                                    <li class=\"time\">
                                        <button class=\"ap-book p-3 mt-2\"><b>4:00 PM</b></button>
                                    </li>
                                    <li class=\"time\">
                                        <button class=\"ap-book p-3 mt-2\"><b>4:30 PM</b></button>
                                    </li>
                                    <li class=\"time\">
                                        <button class=\"ap-book p-3 mt-2\"><b>5:00 PM</b></button>
                                    </li>
                                    <li class=\"time\">
                                        <button class=\"ap-book p-3 mt-2\"><b>4:30 PM</b></button>
                                    </li>
                                    <li class=\"time\">
                                        <button class=\"ap-book p-3 mt-2\"><b>2:00 PM</b></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                <div id=\"1\" class=\" tab-pane fade\"><br>
                    <div id=\"home\" class=\" tab-pane active\"><br>
                        <div id=\"brain\" class=\" tab-pane active\"><br>
                            <div class=\"col-lg-8 col-sm-12 pt-4\">
                                <div class=\"row\">

                                    <div class=\"owl-carousel dateslider\">
                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">MON</div>
                                            <div class=\"date text-center\">16</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Tue</div>
                                            <div class=\"date text-center\">17</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Wed</div>
                                            <div class=\"date text-center\">18</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Thu</div>
                                            <div class=\"date text-center\">19</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Fri</div>
                                            <div class=\"date text-center\">20</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Sat</div>
                                            <div class=\"date text-center\">21</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Sun</div>
                                            <div class=\"date text-center\">22</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Mon</div>
                                            <div class=\"date text-center\">23</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Tue</div>
                                            <div class=\"date text-center\">24</div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class=\"d-flex sm-block\">
                                <div class=\"col-sm-1 pt-3\">
                                    <div class=\"location-wrapper\">
                                        <p class=\"text-center p-2 pt-2 fs-1\"><i class=\"fa-solid fa-location-dot \"></i></p>
                                    </div>
                                </div>

                            ";
        // line 513
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, true, true, 513), "field_logos", [], "any", true, true, true, 513) && (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 513), "field_logos", [], "any", false, false, true, 513)) > 0))) {
            // line 514
            echo "                            ";
            $context["Clinic"] = (($__internal_compile_1 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 514), "field_logos", [], "any", false, false, true, 514)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[1] ?? null) : null);
            // line 515
            echo "                                <div class=\"col-lg-8 pt-1\">
                                    <p class=\"fw-400  fs-5\">Clinic Two <br><span>";
            // line 516
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["Clinic"] ?? null), "field_address", [], "any", false, false, true, 516), 516, $this->source), "html", null, true);
            echo "</span></p>
                                </div>
                            ";
        }
        // line 519
        echo "                            </div>

                            <div class=\"row\">
                                <div class=\"fs-3 pt-5\"><b>Evening (5 slots) </b></div>
                                <div class=\"sm-4\">


                                    <ul class=\"time-wrap\">
                                        <li class=\"time\">
                                            <button class=\"ap-book p-3 mt-2\"><b>4:00 PM</b></button>
                                        </li>
                                        <li class=\"time\">
                                            <button class=\"ap-book p-3 mt-2\"><b>4:30 PM</b></button>
                                        </li>
                                        <li class=\"time\">
                                            <button class=\"ap-book p-3 mt-2\"><b>5:00 PM</b></button>
                                        </li>
                                        <li class=\"time\">
                                            <button class=\"ap-book p-3 mt-2\"><b>4:30 PM</b></button>
                                        </li>
                                        <li class=\"time\">
                                            <button class=\"ap-book p-3 mt-2\"><b>2:00 PM</b></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                <div id=\"2\" class=\" tab-pane fade\"><br>
                    <div id=\"home\" class=\" tab-pane active\"><br>
                        <div id=\"brain\" class=\" tab-pane active\"><br>
                            <div class=\"col-lg-8 col-sm-12 pt-4\">
                                <div class=\"row\">

                                    <div class=\"owl-carousel dateslider\">
                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">MON</div>
                                            <div class=\"date text-center\">16</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Tue</div>
                                            <div class=\"date text-center\">17</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Wed</div>
                                            <div class=\"date text-center\">18</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Thu</div>
                                            <div class=\"date text-center\">19</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Fri</div>
                                            <div class=\"date text-center\">20</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Sat</div>
                                            <div class=\"date text-center\">21</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Sun</div>
                                            <div class=\"date text-center\">22</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Mon</div>
                                            <div class=\"date text-center\">23</div>
                                        </div>

                                        <div class=\"date-wrapper\">
                                            <div class=\"day text-center\">Tue</div>
                                            <div class=\"date text-center\">24</div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class=\"d-flex sm-block\">
                                <div class=\"col-sm-1 pt-3\">
                                    <div class=\"location-wrapper\">
                                        <p class=\"text-center p-2 pt-2 fs-1\"><i class=\"fa-solid fa-location-dot \"></i></p>
                                    </div>
                                </div>

                            ";
        // line 616
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, true, true, 616), "field_logos", [], "any", true, true, true, 616) && (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 616), "field_logos", [], "any", false, false, true, 616)) > 0))) {
            // line 617
            echo "                            ";
            $context["Clinic"] = (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 617), "field_logos", [], "any", false, false, true, 617)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[2] ?? null) : null);
            // line 618
            echo "                                <div class=\"col-lg-8 pt-1 \">
                                    <p class=\" fw-400 fs-5\">Clinic Three <br><span>";
            // line 619
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["Clinic"] ?? null), "field_address", [], "any", false, false, true, 619), 619, $this->source), "html", null, true);
            echo "</span></p>
                                </div>
                            ";
        }
        // line 622
        echo "


                            </div>

                            <div class=\"row\">

                                <div class=\"col-sm-12\">
                                    <div class=\"fs-3 pt-5\"><b>Morning (5 slots)</b></div>
                                    <button class=\"ap-book p-3 mt-2\"><b>9AM - 12 noon </b> <span class=\"text-danger\">No Slot Available</span></button>
                                </div>

                                <div class=\"col-sm-12\">
                                    <div class=\"fs-3 pt-5\"><b>After Noon </b></div>
                                    <button class=\"ap-book p-3 mt-2\"><b>12 noon - 5PM </b> <span class=\"text-danger\">Doctor On Leave</span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>






    </div>

\t
\t";
        // line 653
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 653) == "theme2")) {
            // line 654
            echo "\t\t</div>
\t";
        }
        // line 656
        echo "
</section>

<section id=\"";
        // line 659
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 659) == "theme1")) ? ("sec4") : ("p2sec4")));
        echo "\" class=\"pt-0\">
\t";
        // line 660
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 660) == "theme2")) {
            // line 661
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 663
        echo "    <div class=\"container\">
        <div class=\"row p-2\">
            <h2 class=\"col-lg-9\">Areas of expertise</h2>
            <button class=\"btn mx-end col-lg-3 facilities\">View All Speciality Facilities</button>
        </div>
        <div class=\"row pt-5 sm-hide\">




            ";
        // line 673
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 673), "field_areaofexpertise", [], "any", false, false, true, 673));
        foreach ($context['_seq'] as $context["key"] => $context["data"]) {
            // line 674
            echo "            <div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
                <div class=\"col-sm-4 mx-auto\">
                    <img src=\"";
            // line 676
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["data"], "field_logoexpertise", [], "any", false, false, true, 676), "url", [], "any", false, false, true, 676), 676, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["expimg"] ?? null), "field_logoexpertise", [], "any", false, false, true, 676), "alt", [], "any", false, false, true, 676), 676, $this->source), "html", null, true);
            echo "\" width=\"100%\">
                </div>
                <h6 class=\"text-center p-3\"><b>";
            // line 678
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisehead", [], "any", false, false, true, 678), 678, $this->source), "html", null, true);
            echo "</b></h6>
                <div class=\"text-center\">
                    ";
            // line 680
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisecontent", [], "any", false, false, true, 680), 680, $this->source), "html", null, true);
            echo "
                </div>
            </div>

            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 685
        echo "

        </div>

        ";
        // line 690
        echo "
        <div class=\"owl-carousel expslider d-block d-sm-none pt-5\">

            ";
        // line 693
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 693), "field_areaofexpertise", [], "any", false, false, true, 693));
        foreach ($context['_seq'] as $context["key"] => $context["data"]) {
            // line 694
            echo "            <div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
                <div class=\"col-sm-4 mx-auto\">
                    <img src=\"";
            // line 696
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["data"], "field_logoexpertise", [], "any", false, false, true, 696), "url", [], "any", false, false, true, 696), 696, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["expimg"] ?? null), "field_logoexpertise", [], "any", false, false, true, 696), "alt", [], "any", false, false, true, 696), 696, $this->source), "html", null, true);
            echo "\" class=\"mx-auto\" style=\"width:50% !important;\">
                </div>

                <h6 class=\"text-center p-3\"><b>";
            // line 699
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisehead", [], "any", false, false, true, 699), 699, $this->source), "html", null, true);
            echo "</b></h6>
                <div class=\"text-center\">";
            // line 700
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisecontent", [], "any", false, false, true, 700), 700, $this->source), "html", null, true);
            echo "</div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 703
        echo "

        </div>
    </div>

\t
\t";
        // line 709
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 709) == "theme2")) {
            // line 710
            echo "\t\t</div>
\t";
        }
        // line 712
        echo "
</section>

<section id=\"";
        // line 715
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 715) == "theme1")) ? ("sec5") : ("p2sec5")));
        echo "\" class=\"\">
\t";
        // line 716
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 716) == "theme2")) {
            // line 717
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 719
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
        // line 733
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "news_categoery", [], "any", false, false, true, 733));
        foreach ($context['_seq'] as $context["key"] => $context["categorey"]) {
            // line 734
            echo "\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1 cat-news-load\" data-id=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["categorey"], "term_id", [], "any", false, false, true, 734), 734, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["categorey"], "term_name", [], "any", false, false, true, 734), 734, $this->source), "html", null, true);
            echo " </p>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['categorey'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 736
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"news_cls\">
\t\t\t\t<h5 class=\"p-3\">";
        // line 741
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "node_count", [], "any", false, false, true, 741), 741, $this->source), "html", null, true);
        echo " Results</h5>
\t\t\t\t<div class=\"row\">
\t\t\t\t";
        // line 743
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "article", [], "any", false, false, true, 743));
        foreach ($context['_seq'] as $context["key"] => $context["news_article"]) {
            // line 744
            echo "\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 d-none d-sm-block\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"";
            // line 746
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "thumb", [], "any", false, false, true, 746), 746, $this->source), "html", null, true);
            echo "\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By ";
            // line 748
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "author", [], "any", false, false, true, 748), 748, $this->source), "html", null, true);
            echo " </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">";
            // line 749
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "date", [], "any", false, false, true, 749), 749, $this->source), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>";
            // line 752
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "title", [], "any", false, false, true, 752), 752, $this->source), "html", null, true);
            echo "</b></h6>
\t\t\t\t\t\t\t\t<div>";
            // line 753
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "body", [], "any", false, false, true, 753), 753, $this->source));
            echo "
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['news_article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 761
        echo "


                <div class=\"owl-carousel blogslider d-block d-sm-none\">
                 ";
        // line 765
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "article", [], "any", false, false, true, 765));
        foreach ($context['_seq'] as $context["key"] => $context["news_article"]) {
            // line 766
            echo "                    <div class=\"col-lg-4 col-md-6 col-sm-4\">
                        <div class=\"articele-wrapper pb-5\">
                            <img src=\"";
            // line 768
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "thumb", [], "any", false, false, true, 768), 768, $this->source), "html", null, true);
            echo "\" width=\"100%\">
                            <div class=\"d-flex mx-4 mt-2\">
                                <div class=\"offset-lg-0\">";
            // line 770
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "author", [], "any", false, false, true, 770), 770, $this->source), "html", null, true);
            echo " </div>
                                <div class=\"offset-lg-1\">";
            // line 771
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "date", [], "any", false, false, true, 771), 771, $this->source), "html", null, true);
            echo "</div>
                            </div>
                            <div class=\"p-4 pt-0\">

                                <h6 class=\"pt-3 \"><b>";
            // line 775
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "title", [], "any", false, false, true, 775), 775, $this->source), "html", null, true);
            echo "</b></h6>
                                <div>";
            // line 776
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "body", [], "any", false, false, true, 776), 776, $this->source));
            echo "
                                    <button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
                                </div>

                            </div>
                        </div>
                    </div>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['news_article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 784
        echo "                </div>
\t\t\t</div>
\t\t</div>
\t</div>





\t\t";
        // line 793
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 793) == "theme2")) {
            // line 794
            echo "\t\t</div>
\t";
        }
        // line 796
        echo "</section>



<section id=\"";
        // line 800
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 800) == "theme1")) ? ("sec6") : ("p2sec6")));
        echo "\" class=\"p-2\">
\t";
        // line 801
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 801) == "theme2")) {
            // line 802
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 804
        echo "    <div class=\"container\">
        <p class=\"text-center fs-5 pt-5\">Patient Experience</p>
        <h2 class=\"text-center pb-4\">What patients say about the doctor</h2>
        <div class=\"col-sm-12 border border-dark-subtle rounded p-4\">
            <div class=\"row\">
                <input type=\"search\" class=\"p-3 col-sm-9\" placeholder=\"Patient Experience\">
                <div class=\"col-sm-3 d-flex\"> <span class=\"pt-3\">Sort By: </span>
                    <div class=\"dropdown mx-2\">
                        <button type=\"button\" class=\"btn p-3 dropdown-toggle border border-dark-subtle\" data-bs-toggle=\"dropdown\">
                            Most Recent
                        </button>
                        <ul class=\"dropdown-menu\">
                            <li><a class=\"dropdown-item\" href=\"#\">Normal</a></li>
                            <li><a class=\"dropdown-item active\" href=\"#\">Active</a></li>
                            <li><a class=\"dropdown-item disabled\" href=\"#\">Disabled</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"row\">
            <div class=\"col-sm-12 border border-dark-subtle rounded mt-5 pb-3 pt-3\">
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">All Patient Experiences</button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks</button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy </button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\"> cancer and tumors</button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\"> craniosynostosis</button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">All Reviews </button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks </button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
                <button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
            </div>
        </div>

        <div class=\"row sm-hide\">

            ";
        // line 842
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 842), "field_testimonials", [], "any", false, false, true, 842));
        foreach ($context['_seq'] as $context["key"] => $context["testimonials"]) {
            // line 843
            echo "
            <div class=\"col-sm-6 p-4\">
                <div class=\"test-wrapp\">
                    <div class=\"p-3\">
                        <div class=\"quotes\"><i class=\"fa-solid fa-quote-left\"></i></div>
                        <h4><b>";
            // line 848
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_head", [], "any", false, false, true, 848), 848, $this->source), "html", null, true);
            echo "</b></h4>
                        <br>
                        <p class=\"text-black\">";
            // line 850
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_content", [], "any", false, false, true, 850), 850, $this->source), "html", null, true);
            echo "</p>
                        <div class=\"row\">
                            <div class=\"col-sm-3\">
                                <img src=\"";
            // line 853
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 853), "url", [], "any", false, false, true, 853), 853, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 853), "alt", [], "any", false, false, true, 853), 853, $this->source), "html", null, true);
            echo "\" class=\"pt-2 img-fluid d-block mx-auto\">
                            </div>
                            <div class=\"col-md-12 col-sm-6 pt-2\">
                                <div class=\"fw-bolder\">";
            // line 856
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_patienname", [], "any", false, false, true, 856), 856, $this->source), "html", null, true);
            echo "</div>
                                <button class=\"rel-btn p-2 m-2 btn\">Aneurysm</button>
                                <button class=\"rel-btn p-2 m-2 btn\">Hedeche</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['testimonials'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 866
        echo "
        </div>

        ";
        // line 870
        echo "
        <div class=\"row owl-carousel testimonial-slider d-block d-sm-none\">

            ";
        // line 873
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 873), "field_testimonials", [], "any", false, false, true, 873));
        foreach ($context['_seq'] as $context["key"] => $context["testimonials"]) {
            // line 874
            echo "            <div class=\"col-sm-6 p-4\">
                <div class=\"test-wrapp\">
                    <div class=\"p-3\">
                        <div class=\"quotes\"><i class=\"fa-solid fa-quote-left\"></i></div>
                        <b>";
            // line 878
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_head", [], "any", false, false, true, 878), 878, $this->source), "html", null, true);
            echo "</b><br>
                        ";
            // line 879
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_content", [], "any", false, false, true, 879), 879, $this->source), "html", null, true);
            echo "

                        <div class=\"row\">
                            <div class=\"col-sm-3\">
                                <img src=\"";
            // line 883
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 883), "url", [], "any", false, false, true, 883), 883, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 883), "alt", [], "any", false, false, true, 883), 883, $this->source), "html", null, true);
            echo "\" class=\"pt-2 timg img-fluid d-block mx-auto\">
                            </div>
                            <div class=\"col-md-12 col-sm-6 pt-2\">
                                <div class=\"fw-bolder\">";
            // line 886
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_patienname", [], "any", false, false, true, 886), 886, $this->source), "html", null, true);
            echo "</div>
                                <button class=\"rel-btn p-2 m-2 btn\">Aneurysm</button>
                                <button class=\"rel-btn p-2 m-2 btn\">Hedeche</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['testimonials'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 896
        echo "
        </div>


    </div>

\t\t\t";
        // line 902
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 902) == "theme2")) {
            // line 903
            echo "\t\t</div>
\t";
        }
        // line 905
        echo "</section>

<section id=\"";
        // line 907
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 907) == "theme1")) ? ("sec7") : ("p2sec7")));
        echo "\" class=\"pt-5 pb-5\">
\t";
        // line 908
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 908) == "theme2")) {
            // line 909
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 911
        echo "    <div class=\"container\">
        <h2 class=\"text-center pb-5\">Frequently Asked Questions</h2>

        <div class=\"col-sm-12 border border-dark-subtle rounded p-4\">
            <div class=\"row\">
                <input type=\"search\" class=\"p-3 col-sm-9\" placeholder=\"Search For Answers\">
                <div class=\"col-sm-3 d-flex\"> <span class=\"pt-3\">Sort By: </span>
                    <div class=\"dropdown mx-2\">
                        <button type=\"button\" class=\"btn p-3 dropdown-toggle border border-dark-subtle\" data-bs-toggle=\"dropdown\">
                            Most Recent
                        </button>
                        <ul class=\"dropdown-menu\">
                            <li><a class=\"dropdown-item\" href=\"#\">Normal</a></li>
                            <li><a class=\"dropdown-item active\" href=\"#\">Active</a></li>
                            <li><a class=\"dropdown-item disabled\" href=\"#\">Disabled</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class=\"col-sm-12 border border-dark-subtle rounded p-3 mt-5\">
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">All Patient Experiences</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks </button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">All Reviews</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
            <button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
        </div>

        <div class=\"container pt-5\">
            <div class=\"accordion\">
                <div class=\"row\">
                    ";
        // line 949
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 949), "field_faq", [], "any", false, false, true, 949));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["key"] => $context["faq"]) {
            // line 950
            echo "                    <div class=\"col-lg-6 col-md-6 mb-4\">
                        <article class=\"accordion-item rounded\">
                            <span class=\"accordion-label\">";
            // line 952
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 952), 952, $this->source), "html", null, true);
            echo ") ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["faq"], "field_header", [], "any", false, false, true, 952), 952, $this->source), "html", null, true);
            echo "</span>
                            <div class=\"accordion-content\">
                                <p>";
            // line 954
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["faq"], "field_content", [], "any", false, false, true, 954), 954, $this->source), "html", null, true);
            echo "</p>
                            </div>
                        </article>
                    </div>
                    ";
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
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['faq'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 959
        echo "
                </div>
            </div>
        </div>

    </div>
\t\t\t";
        // line 965
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 965) == "theme2")) {
            // line 966
            echo "\t\t</div>
\t";
        }
        // line 968
        echo "
</section>


<div class=\"pt-3\">
    <iframe src=\"";
        // line 973
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 973), "field_map", [], "any", false, false, true, 973), 973, $this->source), "html", null, true);
        echo "\" class=\"map\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>
</div>

<script src=\"assets/js/main.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js\"></script>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["arr_data", "loop", "expimg"]);    }

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
        return array (  1649 => 973,  1642 => 968,  1638 => 966,  1636 => 965,  1628 => 959,  1609 => 954,  1602 => 952,  1598 => 950,  1581 => 949,  1541 => 911,  1537 => 909,  1535 => 908,  1531 => 907,  1527 => 905,  1523 => 903,  1521 => 902,  1513 => 896,  1497 => 886,  1489 => 883,  1482 => 879,  1478 => 878,  1472 => 874,  1468 => 873,  1463 => 870,  1458 => 866,  1442 => 856,  1434 => 853,  1428 => 850,  1423 => 848,  1416 => 843,  1412 => 842,  1372 => 804,  1368 => 802,  1366 => 801,  1362 => 800,  1356 => 796,  1352 => 794,  1350 => 793,  1339 => 784,  1325 => 776,  1321 => 775,  1314 => 771,  1310 => 770,  1305 => 768,  1301 => 766,  1297 => 765,  1291 => 761,  1277 => 753,  1273 => 752,  1267 => 749,  1263 => 748,  1258 => 746,  1254 => 744,  1250 => 743,  1245 => 741,  1238 => 736,  1227 => 734,  1223 => 733,  1207 => 719,  1203 => 717,  1201 => 716,  1197 => 715,  1192 => 712,  1188 => 710,  1186 => 709,  1178 => 703,  1169 => 700,  1165 => 699,  1157 => 696,  1153 => 694,  1149 => 693,  1144 => 690,  1138 => 685,  1127 => 680,  1122 => 678,  1115 => 676,  1111 => 674,  1107 => 673,  1095 => 663,  1091 => 661,  1089 => 660,  1085 => 659,  1080 => 656,  1076 => 654,  1074 => 653,  1041 => 622,  1035 => 619,  1032 => 618,  1029 => 617,  1027 => 616,  928 => 519,  922 => 516,  919 => 515,  916 => 514,  914 => 513,  806 => 407,  800 => 404,  797 => 403,  794 => 402,  792 => 401,  724 => 335,  718 => 334,  710 => 331,  707 => 330,  699 => 327,  696 => 326,  693 => 325,  689 => 324,  682 => 319,  678 => 317,  676 => 316,  672 => 315,  666 => 311,  662 => 309,  660 => 308,  655 => 305,  646 => 303,  642 => 302,  623 => 286,  613 => 278,  599 => 277,  593 => 275,  590 => 274,  573 => 273,  566 => 269,  554 => 260,  548 => 257,  542 => 254,  519 => 233,  515 => 231,  513 => 230,  506 => 228,  498 => 222,  485 => 211,  474 => 209,  471 => 208,  467 => 207,  462 => 204,  456 => 203,  450 => 201,  444 => 199,  442 => 198,  437 => 197,  434 => 196,  429 => 195,  426 => 194,  423 => 193,  421 => 192,  413 => 187,  406 => 183,  389 => 169,  382 => 165,  376 => 161,  365 => 159,  362 => 158,  358 => 157,  352 => 153,  346 => 152,  340 => 150,  334 => 148,  332 => 147,  327 => 146,  324 => 145,  319 => 144,  316 => 143,  313 => 142,  311 => 141,  304 => 137,  295 => 133,  289 => 130,  285 => 129,  281 => 128,  274 => 126,  258 => 113,  248 => 108,  241 => 104,  237 => 103,  227 => 98,  217 => 93,  211 => 89,  190 => 70,  181 => 67,  178 => 66,  174 => 65,  166 => 60,  161 => 58,  154 => 54,  148 => 50,  142 => 49,  136 => 47,  130 => 45,  128 => 44,  123 => 43,  120 => 42,  116 => 41,  113 => 40,  110 => 39,  107 => 38,  105 => 37,  98 => 35,  92 => 32,  79 => 24,  74 => 22,  70 => 21,  66 => 20,  50 => 9,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/userprofile/templates/profile-custom-template.html.twig", "C:\\xampp\\htdocs\\linqmd\\modules\\custom\\userprofile\\templates\\profile-custom-template.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "set" => 37, "for" => 41);
        static $filters = array("escape" => 9, "round" => 38, "length" => 401, "raw" => 753);
        static $functions = array("range" => 41);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 'round', 'length', 'raw'],
                ['range']
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
