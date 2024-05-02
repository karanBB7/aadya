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

/* modules/custom/userprofile/templates/profile-doctor-custom-template.html.twig */
class __TwigTemplate_f477af8ce0717d8ae16269b9ce5f1e82 extends Template
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
\t<section id=\"p2sec1\" class=\"theme2\">
        <div class=\"secondtheme\">
            <div class=\"banner\"></div>
            <div class=\"gotop p-5 pb-0 d-none d-xl-block\">
                <div class=\"flx pb-0\">

                    <div class=\"cont\">
                        <div class=\"col-sm-3 \">
                            <img src=\"";
            // line 98
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 98), "field_background_image", [], "any", false, false, true, 98), "url", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 98), "field_background_image", [], "any", false, false, true, 98), "alt", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "\" width=\"100%\">
                        </div>
                    </div>
                    <div class=\"red_theme\">
                        <div class=\"box-cont d-flex\">
                            <div class=\"col-sm-10 box-data p-3\">
                                <h1 class=\"\">";
            // line 104
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 104), "field_name", [], "any", false, false, true, 104), 104, $this->source), "html", null, true);
            echo "</h1>
                                <p class=\"pt-3 col-sm-10 \"><b>";
            // line 105
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 105), "field_allcertifications", [], "any", false, false, true, 105), 105, $this->source), "html", null, true);
            echo "</b></p>
                                <p class=\"pt-3 fs-6  tc\">";
            // line 106
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 106), "field_phone_number", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 106), "field_email_address", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
            echo "</p>
                            </div>

                            <div>
                                <button class=\"btn appbtn p-2 mb-2 order-lg-2 order-sm-2\">Book an appointment</button>
                                <a href=\"https://api.whatsapp.com/send?phone=";
            // line 111
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 111), "field_phone_number", [], "any", false, false, true, 111), 111, $this->source), "html", null, true);
            echo "&text=Hello.\" target=\"_blank\"><button class=\"whatsappbtn btn mb-2 \"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"row p-4\">
                    <div class=\"col-sm-2\"></div>
                    <div class=\"col-sm-8\">
                        <div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col-sm-4\">
                                    <p class=\"fs-2\"><span class=\"ten\"><b>";
            // line 123
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 123), "field_experiences", [], "any", false, false, true, 123), 123, $this->source), "html", null, true);
            echo " Years <span class=\"fs-6\">Experience</span></b></span></p>
                                </div>

                                <div class=\"col-sm-4\">
                                    <p class=\"fs-2\"><b><span class=\"ten\">";
            // line 127
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 127), "field_patients", [], "any", false, false, true, 127), 127, $this->source), "html", null, true);
            echo "k+</span> Patients</b></p>
                                </div>
                                <div class=\"col-sm-4\">
                                    <div class=\"rating float-start mb-3 mt-3 order-lg-2 order-sm-2\" id=\"rating\">
                                        ";
            // line 131
            $context["value"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 131), "field_profilerating", [], "any", false, false, true, 131);
            // line 132
            echo "\t\t\t\t\t\t\t\t\t\t";
            $context["wholeStars"] = twig_round($this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 132, $this->source), 0, "floor");
            // line 133
            echo "\t\t\t\t\t\t\t\t\t\t";
            $context["remainder"] = (($context["value"] ?? null) - ($context["wholeStars"] ?? null));
            // line 134
            echo "
\t\t\t\t\t\t\t\t\t\t";
            // line 135
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 136
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                if (($context["i"] <= ($context["wholeStars"] ?? null))) {
                    // line 137
                    echo "\t\t\t\t\t\t\t\t\t\t\t<span class=\"star filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 137, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
\t\t\t\t\t\t\t\t\t\t\t\t";
                } elseif (((                // line 138
$context["i"] == (($context["wholeStars"] ?? null) + 1)) && (($context["remainder"] ?? null) > 0))) {
                    // line 139
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"star half-filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 139, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
\t\t\t\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 141
                    echo "\t\t\t\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 141, $this->source), "html", null, true);
                    echo "\">&#9734;</span>
\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 143
                echo "\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 144
            echo "                                    </div>
                                </div>
\t\t\t\t\t\t\t";
            // line 146
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 146), "field_logos", [], "any", false, false, true, 146));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                echo "\t
                                <div class=\"col-sm-4\">
\t\t\t\t\t\t\t\t<img src=\"";
                // line 148
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 148), "url", [], "any", false, false, true, 148), 148, $this->source), "html", null, true);
                echo "\" width=\"100%\">
\t\t\t\t\t\t\t\t</div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 151
            echo "                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class=\"sm-device d-xl-none\">
                <div class=\"container gotopsm \">

                    <div class=\"ppWrapper mx-auto\">
                        <img src=\"";
            // line 162
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 162), "field_background_image", [], "any", false, false, true, 162), "url", [], "any", false, false, true, 162), 162, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 162), "field_background_image", [], "any", false, false, true, 162), "alt", [], "any", false, false, true, 162), 162, $this->source), "html", null, true);
            echo "\" width=\"100%\">
                    </div>

                    <div class=\"profile-wrapper p-5\">
                        <h1 class=\" text-center pt-5\">";
            // line 166
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 166), "field_name", [], "any", false, false, true, 166), 166, $this->source), "html", null, true);
            echo "</h1>
                        <p class=\"pt-2 col-sm-10 text-center\"><b>";
            // line 167
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 167), "field_speciality", [], "any", false, false, true, 167), 167, $this->source), "html", null, true);
            echo "</b></p>
                        <p class=\"pt-2 fs-6  tc text-center\">";
            // line 168
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 168), "field_phone_number", [], "any", false, false, true, 168), 168, $this->source), "html", null, true);
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 168), "field_email_address", [], "any", false, false, true, 168), 168, $this->source), "html", null, true);
            echo "</p>
                    </div>

                    <button class=\"btn appbtnsm mx-auto d-block p-2 mb-2 order-lg-2 order-sm-2\">Make an appointment</button>

                    <a href=\"https://api.whatsapp.com/send?phone=";
            // line 173
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 173), "field_phone_number", [], "any", false, false, true, 173), 173, $this->source), "html", null, true);
            echo "&text=Hello.\" target=\"_blank\"><button class=\"whatsappbtn mx-auto d-block btn mb-2\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button></a>

                    <div class=\"col-sm-6 mx-auto\">
                        <div class=\"rating  mb-3 mt-3 \" id=\"rating\">
                            ";
            // line 177
            $context["value"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 177), "field_profilerating", [], "any", false, false, true, 177);
            // line 178
            echo "\t\t\t\t\t\t\t";
            $context["wholeStars"] = twig_round($this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 178, $this->source), 0, "floor");
            // line 179
            echo "\t\t\t\t\t\t\t";
            $context["remainder"] = (($context["value"] ?? null) - ($context["wholeStars"] ?? null));
            // line 180
            echo "\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 181
                echo "\t\t\t\t\t\t\t\t";
                if (($context["i"] <= ($context["wholeStars"] ?? null))) {
                    // line 182
                    echo "\t\t\t\t\t\t\t\t<span class=\"star filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 182, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
\t\t\t\t\t\t\t\t\t";
                } elseif (((                // line 183
$context["i"] == (($context["wholeStars"] ?? null) + 1)) && (($context["remainder"] ?? null) > 0))) {
                    // line 184
                    echo "\t\t\t\t\t\t\t\t\t<span class=\"star half-filled\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 184, $this->source), "html", null, true);
                    echo "\">&#9733;</span>
\t\t\t\t\t\t\t\t\t";
                } else {
                    // line 186
                    echo "\t\t\t\t\t\t\t\t<span class=\"star\" data-value=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 186, $this->source), "html", null, true);
                    echo "\">&#9734;</span>
\t\t\t\t\t\t\t\t";
                }
                // line 188
                echo "\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 189
            echo "                        </div>
                    </div>

                </div>

                <div class=\"d-flex mx-auto top-fix\">
\t\t\t\t";
            // line 195
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 195), "field_logos", [], "any", false, false, true, 195));
            foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
                // line 196
                echo "                    <div class=\"col-md-4\"><img src=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 196), "url", [], "any", false, false, true, 196), 196, $this->source), "html", null, true);
                echo "\" width=\"100%\"></div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 197
            echo "    
                </div>

                <div class=\"d-flex top-fix\">
                    <div class=\"col-sm-4 p-3\">
                        <p class=\"fs-2\"><span class=\"ten\"><b>";
            // line 202
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 202), "field_experiences", [], "any", false, false, true, 202), 202, $this->source), "html", null, true);
            echo "+ Years <span class=\"fs-6\">Experience</span></b></span></p>
                    </div>

                    <div class=\"col-sm-4 p-3\">
                        <p class=\"fs-2\"><b><span class=\"ten\">";
            // line 206
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 206), "field_patients", [], "any", false, false, true, 206), 206, $this->source), "html", null, true);
            echo "k+</span> Patients</b></p>
                    </div>
                </div>
            </div>

        </div>

\t\t
    </section>

";
        }
        // line 217
        echo "








<section id=\"";
        // line 226
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 226) == "theme1")) ? ("sec2") : ("p2sec2")));
        echo "\" class=\"pt-5 pb-5 ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 226) == "theme1")) ? ("") : ("theme2")));
        echo "\">

\t\t";
        // line 228
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 228) == "theme2")) {
            // line 229
            echo "\t\t\t<div class=\"secondtheme\">
\t\t";
        }
        // line 231
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
        // line 252
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 252), "field_overview", [], "any", false, false, true, 252), 252, $this->source), "html", null, true);
        echo "</p>
                        <br>
                        <h2><b>Education</b></h2>
                        <p>";
        // line 255
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 255), "field_allcertifications", [], "any", false, false, true, 255), 255, $this->source), "html", null, true);
        echo "</p>
                    </div>
                    <div class=\"col-lg-5 col-sm-5 \">
                        <img class=\"img-fluid mx-auto d-block\" alt=\"\" src=\"";
        // line 258
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 258), "field_displaypicture", [], "any", false, false, true, 258), "url", [], "any", false, false, true, 258), 258, $this->source), "html", null, true);
        echo "\" alt=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 258), "field_displaypicture", [], "any", false, false, true, 258), "alt", [], "any", false, false, true, 258), 258, $this->source), "html", null, true);
        echo "\">
                    </div>
                </div>

            </div>

            <div id=\"speciality\" class=\"container tab-pane fade pt-4\"><br>
                <div class=\"row\">
                    <div class=\"col-lg-7 col-sm-7 pilltext\">
                        <p>";
        // line 267
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 267), "field_specialities", [], "any", false, false, true, 267), 267, $this->source), "html", null, true);
        echo "</p>
                        <br>
                    </div>
                    <div class=\"col-lg-5 col-sm-5\">
                        ";
        // line 271
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 271), "field_youtube", [], "any", false, false, true, 271));
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
            // line 272
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 272) == 3)) {
                // line 273
                echo "                        <iframe width=\"100%\" height=\"100%\" src=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["url"], "field_youtube_embede", [], "any", false, false, true, 273), 273, $this->source), "html", null, true);
                echo "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>
                        ";
            }
            // line 275
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
        // line 276
        echo "
                    </div>
                </div>
            </div>

            <div id=\"summary\" class=\"container tab-pane fade pt-4\"><br>
                <div class=\"row\">
                    <div class=\"col-lg-12 pilltext\">
                        <p>";
        // line 284
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 284), "field_expertise_summary", [], "any", false, false, true, 284), 284, $this->source), "html", null, true);
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
        // line 300
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 300), "field_youtube", [], "any", false, false, true, 300));
        foreach ($context['_seq'] as $context["key"] => $context["url"]) {
            // line 301
            echo "            <iframe class=\"p-3 mx-auto d-block\" width=\"80%\" src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["url"], "field_youtube_embede", [], "any", false, false, true, 301), 301, $this->source), "html", null, true);
            echo "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['url'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 303
        echo "        </div>
    </div>

\t";
        // line 306
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 306) == "theme2")) {
            // line 307
            echo "\t\t</div>
\t";
        }
        // line 309
        echo "
</section>


<section id=\"";
        // line 313
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 313) == "theme1")) ? ("sec3") : ("p2sec3")));
        echo "\" class=\"p-5 pb-3\">
\t";
        // line 314
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 314) == "theme2")) {
            // line 315
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 317
        echo "

    <div class=\"container\">
    <h2>Book Appointment</h2>
    <ul class=\"nav nav-pills\">
        ";
        // line 322
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 322), "field_logos", [], "any", false, false, true, 322));
        foreach ($context['_seq'] as $context["k"] => $context["clinic"]) {
            // line 323
            echo "            ";
            if (($context["k"] == "0")) {
                // line 324
                echo "                <li class=\"nav-item\">
                    <a class=\"nav-link active\" data-bs-toggle=\"pill\" href=\"#";
                // line 325
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["k"], 325, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["clinic"], "field_clinicname", [], "any", false, false, true, 325), 325, $this->source), "html", null, true);
                echo "</a>
                </li>
            ";
            } else {
                // line 328
                echo "                <li class=\"nav-item\">
                    <a class=\"nav-link\" data-bs-toggle=\"pill\" href=\"#";
                // line 329
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["k"], 329, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["clinic"], "field_clinicname", [], "any", false, false, true, 329), 329, $this->source), "html", null, true);
                echo "</a>
                </li>
            ";
            }
            // line 332
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['clinic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 333
        echo "    </ul>


            <div class=\"tab-content\">
                <div id=\"0\" class=\"container tab-pane active\"><br>
                    <div id=\"brain\" class=\"container tab-pane active\"><br>
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


                        <div class=\"d-flex\">
                            <div class=\"col-sm-1 pt-3\">
                                <div class=\"location-wrapper\">
                                    <p class=\"text-center p-2 pt-2 fs-1\"><i class=\"fa-solid fa-location-dot \"></i></p>
                                </div>
                            </div>

                            <div class=\"col-sm-5 pt-1\">
                                <p class=\"loctext fw-bold fs-5\">Clinic One <br><span>51 Goldhill Plaza #19-10/12 Banglore 308900</span></p>
                            </div>
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



                <div id=\"1\" class=\"container tab-pane fade\"><br>
                    <div id=\"home\" class=\"container tab-pane active\"><br>
                        <div id=\"brain\" class=\"container tab-pane active\"><br>
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


                            <div class=\"d-flex\">
                                <div class=\"col-sm-1 pt-3\">
                                    <div class=\"location-wrapper\">
                                        <p class=\"text-center p-2 pt-2 fs-1\"><i class=\"fa-solid fa-location-dot \"></i></p>
                                    </div>
                                </div>

                                <div class=\"col-sm-5 pt-1\">
                                    <p class=\"loctext fw-bold fs-5\">Clinic Two <br><span>51 Goldhill Plaza #19-10/12 Banglore 308900</span></p>
                                </div>
                            </div>

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



                <div id=\"2\" class=\"container tab-pane fade\"><br>
                    <div id=\"home\" class=\"container tab-pane active\"><br>
                        <div id=\"brain\" class=\"container tab-pane active\"><br>
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


                            <div class=\"d-flex\">
                                <div class=\"col-sm-1 pt-3\">
                                    <div class=\"location-wrapper\">
                                        <p class=\"text-center p-2 pt-2 fs-1\"><i class=\"fa-solid fa-location-dot \"></i></p>
                                    </div>
                                </div>

                                <div class=\"col-sm-5 pt-1\">
                                    <p class=\"loctext fw-bold fs-5\">Clinic Three <br><span>51 Goldhill Plaza #19-10/12 Banglore 308900</span></p>
                                </div>
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
        // line 640
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 640) == "theme2")) {
            // line 641
            echo "\t\t</div>
\t";
        }
        // line 643
        echo "
</section>

<section id=\"";
        // line 646
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 646) == "theme1")) ? ("sec4") : ("p2sec4")));
        echo "\" class=\"pt-0\">
\t";
        // line 647
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 647) == "theme2")) {
            // line 648
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 650
        echo "    <div class=\"container\">
        <div class=\"row p-2\">
            <h2 class=\"col-lg-9\">Areas of expertise</h2>
            <button class=\"btn mx-end col-lg-3 facilities\">View All Speciality Facilities</button>
        </div>
        <div class=\"row pt-5 sm-hide\">




            ";
        // line 660
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 660), "field_areaofexpertise", [], "any", false, false, true, 660));
        foreach ($context['_seq'] as $context["key"] => $context["data"]) {
            // line 661
            echo "            <div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
                <div class=\"col-sm-4 mx-auto\">
                    <img src=\"";
            // line 663
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["data"], "field_logoexpertise", [], "any", false, false, true, 663), "url", [], "any", false, false, true, 663), 663, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["expimg"] ?? null), "field_logoexpertise", [], "any", false, false, true, 663), "alt", [], "any", false, false, true, 663), 663, $this->source), "html", null, true);
            echo "\" width=\"100%\">
                </div>
                <h6 class=\"text-center p-3\"><b>";
            // line 665
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisehead", [], "any", false, false, true, 665), 665, $this->source), "html", null, true);
            echo "</b></h6>
                <div class=\"text-center\">
                    ";
            // line 667
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisecontent", [], "any", false, false, true, 667), 667, $this->source), "html", null, true);
            echo "
                </div>
            </div>

            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 672
        echo "

        </div>

        ";
        // line 677
        echo "
        <div class=\"owl-carousel expslider d-block d-sm-none pt-5\">

            ";
        // line 680
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 680), "field_areaofexpertise", [], "any", false, false, true, 680));
        foreach ($context['_seq'] as $context["key"] => $context["data"]) {
            // line 681
            echo "            <div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
                <div class=\"col-sm-4 mx-auto\">
                    <img src=\"";
            // line 683
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["data"], "field_logoexpertise", [], "any", false, false, true, 683), "url", [], "any", false, false, true, 683), 683, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["expimg"] ?? null), "field_logoexpertise", [], "any", false, false, true, 683), "alt", [], "any", false, false, true, 683), 683, $this->source), "html", null, true);
            echo "\" class=\"mx-auto\" style=\"width:50% !important;\">
                </div>

                <h6 class=\"text-center p-3\"><b>";
            // line 686
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisehead", [], "any", false, false, true, 686), 686, $this->source), "html", null, true);
            echo "</b></h6>
                <div class=\"text-center\">";
            // line 687
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisecontent", [], "any", false, false, true, 687), 687, $this->source), "html", null, true);
            echo "</div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 690
        echo "

        </div>
    </div>

\t
\t";
        // line 696
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 696) == "theme2")) {
            // line 697
            echo "\t\t</div>
\t";
        }
        // line 699
        echo "
</section>

<section id=\"";
        // line 702
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 702) == "theme1")) ? ("sec5") : ("p2sec5")));
        echo "\" class=\"\">
\t";
        // line 703
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 703) == "theme2")) {
            // line 704
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 706
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
        // line 720
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "news_categoery", [], "any", false, false, true, 720));
        foreach ($context['_seq'] as $context["key"] => $context["categorey"]) {
            // line 721
            echo "\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1 cat-news-load\" data-id=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["categorey"], "term_id", [], "any", false, false, true, 721), 721, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["categorey"], "term_name", [], "any", false, false, true, 721), 721, $this->source), "html", null, true);
            echo " </p>
\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['categorey'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 723
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"news_cls\">
\t\t\t\t<h5 class=\"p-3\">";
        // line 728
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "node_count", [], "any", false, false, true, 728), 728, $this->source), "html", null, true);
        echo " Results</h5>
\t\t\t\t<div class=\"row\">
\t\t\t\t";
        // line 730
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "article", [], "any", false, false, true, 730));
        foreach ($context['_seq'] as $context["key"] => $context["news_article"]) {
            // line 731
            echo "\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 d-none d-sm-block\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"";
            // line 733
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "thumb", [], "any", false, false, true, 733), 733, $this->source), "html", null, true);
            echo "\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By ";
            // line 735
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "author", [], "any", false, false, true, 735), 735, $this->source), "html", null, true);
            echo " </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">";
            // line 736
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "date", [], "any", false, false, true, 736), 736, $this->source), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>";
            // line 739
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "title", [], "any", false, false, true, 739), 739, $this->source), "html", null, true);
            echo "</b></h6>
\t\t\t\t\t\t\t\t<div>";
            // line 740
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "body", [], "any", false, false, true, 740), 740, $this->source));
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
        // line 748
        echo "


                <div class=\"owl-carousel blogslider d-block d-sm-none\">
                 ";
        // line 752
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "article", [], "any", false, false, true, 752));
        foreach ($context['_seq'] as $context["key"] => $context["news_article"]) {
            // line 753
            echo "                    <div class=\"col-lg-4 col-md-6 col-sm-4\">
                        <div class=\"articele-wrapper pb-5\">
                            <img src=\"";
            // line 755
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "thumb", [], "any", false, false, true, 755), 755, $this->source), "html", null, true);
            echo "\" width=\"100%\">
                            <div class=\"d-flex mx-4 mt-2\">
                                <div class=\"offset-lg-0\">";
            // line 757
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "author", [], "any", false, false, true, 757), 757, $this->source), "html", null, true);
            echo " </div>
                                <div class=\"offset-lg-1\">";
            // line 758
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "date", [], "any", false, false, true, 758), 758, $this->source), "html", null, true);
            echo "</div>
                            </div>
                            <div class=\"p-4 pt-0\">

                                <h6 class=\"pt-3 \"><b>";
            // line 762
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "title", [], "any", false, false, true, 762), 762, $this->source), "html", null, true);
            echo "</b></h6>
                                <div>";
            // line 763
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["news_article"], "body", [], "any", false, false, true, 763), 763, $this->source));
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
        // line 771
        echo "                </div>
\t\t\t</div>
\t\t</div>
\t</div>





\t\t";
        // line 780
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 780) == "theme2")) {
            // line 781
            echo "\t\t</div>
\t";
        }
        // line 783
        echo "</section>



<section id=\"";
        // line 787
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 787) == "theme1")) ? ("sec6") : ("p2sec6")));
        echo "\" class=\"p-2\">
\t";
        // line 788
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 788) == "theme2")) {
            // line 789
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 791
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
        // line 829
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 829), "field_testimonials", [], "any", false, false, true, 829));
        foreach ($context['_seq'] as $context["key"] => $context["testimonials"]) {
            // line 830
            echo "
            <div class=\"col-sm-6 p-4\">
                <div class=\"test-wrapp\">
                    <div class=\"p-3\">
                        <div class=\"quotes\"><i class=\"fa-solid fa-quote-left\"></i></div>
                        <h4><b>";
            // line 835
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_head", [], "any", false, false, true, 835), 835, $this->source), "html", null, true);
            echo "</b></h4>
                        <br>
                        <p class=\"text-black\">";
            // line 837
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_content", [], "any", false, false, true, 837), 837, $this->source), "html", null, true);
            echo "</p>
                        <div class=\"row\">
                            <div class=\"col-sm-3\">
                                <img src=\"";
            // line 840
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 840), "url", [], "any", false, false, true, 840), 840, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 840), "alt", [], "any", false, false, true, 840), 840, $this->source), "html", null, true);
            echo "\" class=\"pt-2 img-fluid d-block mx-auto\">
                            </div>
                            <div class=\"col-md-12 col-sm-6 pt-2\">
                                <div class=\"fw-bolder\">";
            // line 843
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_patienname", [], "any", false, false, true, 843), 843, $this->source), "html", null, true);
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
        // line 853
        echo "
        </div>

        ";
        // line 857
        echo "
        <div class=\"row owl-carousel testimonial-slider d-block d-sm-none\">

            ";
        // line 860
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 860), "field_testimonials", [], "any", false, false, true, 860));
        foreach ($context['_seq'] as $context["key"] => $context["testimonials"]) {
            // line 861
            echo "            <div class=\"col-sm-6 p-4\">
                <div class=\"test-wrapp\">
                    <div class=\"p-3\">
                        <div class=\"quotes\"><i class=\"fa-solid fa-quote-left\"></i></div>
                        <b>";
            // line 865
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_head", [], "any", false, false, true, 865), 865, $this->source), "html", null, true);
            echo "</b><br>
                        ";
            // line 866
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_content", [], "any", false, false, true, 866), 866, $this->source), "html", null, true);
            echo "

                        <div class=\"row\">
                            <div class=\"col-sm-3\">
                                <img src=\"";
            // line 870
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 870), "url", [], "any", false, false, true, 870), 870, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 870), "alt", [], "any", false, false, true, 870), 870, $this->source), "html", null, true);
            echo "\" class=\"pt-2 timg img-fluid d-block mx-auto\">
                            </div>
                            <div class=\"col-md-12 col-sm-6 pt-2\">
                                <div class=\"fw-bolder\">";
            // line 873
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_patienname", [], "any", false, false, true, 873), 873, $this->source), "html", null, true);
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
        // line 883
        echo "
        </div>


    </div>

\t\t\t";
        // line 889
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 889) == "theme2")) {
            // line 890
            echo "\t\t</div>
\t";
        }
        // line 892
        echo "</section>

<section id=\"";
        // line 894
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 894) == "theme1")) ? ("sec7") : ("p2sec7")));
        echo "\" class=\"pt-5 pb-5\">
\t";
        // line 895
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 895) == "theme2")) {
            // line 896
            echo "\t\t<div class=\"secondtheme\">
\t";
        }
        // line 898
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
        // line 936
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 936), "field_faq", [], "any", false, false, true, 936));
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
            // line 937
            echo "                    <div class=\"col-lg-6 col-md-6 mb-4\">
                        <article class=\"accordion-item rounded\">
                            <span class=\"accordion-label\">";
            // line 939
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 939), 939, $this->source), "html", null, true);
            echo ") ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["faq"], "field_header", [], "any", false, false, true, 939), 939, $this->source), "html", null, true);
            echo "</span>
                            <div class=\"accordion-content\">
                                <p>";
            // line 941
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["faq"], "field_content", [], "any", false, false, true, 941), 941, $this->source), "html", null, true);
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
        // line 946
        echo "
                </div>
            </div>
        </div>

    </div>
\t\t\t";
        // line 952
        if ((twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme", [], "any", false, false, true, 952) == "theme2")) {
            // line 953
            echo "\t\t</div>
\t";
        }
        // line 955
        echo "
</section>


<div class=\"pt-3\">
    <iframe src=\"";
        // line 960
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 960), "field_map", [], "any", false, false, true, 960), 960, $this->source), "html", null, true);
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
        return "modules/custom/userprofile/templates/profile-doctor-custom-template.html.twig";
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
        return array (  1595 => 960,  1588 => 955,  1584 => 953,  1582 => 952,  1574 => 946,  1555 => 941,  1548 => 939,  1544 => 937,  1527 => 936,  1487 => 898,  1483 => 896,  1481 => 895,  1477 => 894,  1473 => 892,  1469 => 890,  1467 => 889,  1459 => 883,  1443 => 873,  1435 => 870,  1428 => 866,  1424 => 865,  1418 => 861,  1414 => 860,  1409 => 857,  1404 => 853,  1388 => 843,  1380 => 840,  1374 => 837,  1369 => 835,  1362 => 830,  1358 => 829,  1318 => 791,  1314 => 789,  1312 => 788,  1308 => 787,  1302 => 783,  1298 => 781,  1296 => 780,  1285 => 771,  1271 => 763,  1267 => 762,  1260 => 758,  1256 => 757,  1251 => 755,  1247 => 753,  1243 => 752,  1237 => 748,  1223 => 740,  1219 => 739,  1213 => 736,  1209 => 735,  1204 => 733,  1200 => 731,  1196 => 730,  1191 => 728,  1184 => 723,  1173 => 721,  1169 => 720,  1153 => 706,  1149 => 704,  1147 => 703,  1143 => 702,  1138 => 699,  1134 => 697,  1132 => 696,  1124 => 690,  1115 => 687,  1111 => 686,  1103 => 683,  1099 => 681,  1095 => 680,  1090 => 677,  1084 => 672,  1073 => 667,  1068 => 665,  1061 => 663,  1057 => 661,  1053 => 660,  1041 => 650,  1037 => 648,  1035 => 647,  1031 => 646,  1026 => 643,  1022 => 641,  1020 => 640,  711 => 333,  705 => 332,  697 => 329,  694 => 328,  686 => 325,  683 => 324,  680 => 323,  676 => 322,  669 => 317,  665 => 315,  663 => 314,  659 => 313,  653 => 309,  649 => 307,  647 => 306,  642 => 303,  633 => 301,  629 => 300,  610 => 284,  600 => 276,  586 => 275,  580 => 273,  577 => 272,  560 => 271,  553 => 267,  539 => 258,  533 => 255,  527 => 252,  504 => 231,  500 => 229,  498 => 228,  491 => 226,  480 => 217,  466 => 206,  459 => 202,  452 => 197,  443 => 196,  439 => 195,  431 => 189,  425 => 188,  419 => 186,  413 => 184,  411 => 183,  406 => 182,  403 => 181,  398 => 180,  395 => 179,  392 => 178,  390 => 177,  383 => 173,  373 => 168,  369 => 167,  365 => 166,  356 => 162,  343 => 151,  334 => 148,  327 => 146,  323 => 144,  317 => 143,  311 => 141,  305 => 139,  303 => 138,  298 => 137,  295 => 136,  291 => 135,  288 => 134,  285 => 133,  282 => 132,  280 => 131,  273 => 127,  266 => 123,  251 => 111,  241 => 106,  237 => 105,  233 => 104,  222 => 98,  211 => 89,  190 => 70,  181 => 67,  178 => 66,  174 => 65,  166 => 60,  161 => 58,  154 => 54,  148 => 50,  142 => 49,  136 => 47,  130 => 45,  128 => 44,  123 => 43,  120 => 42,  116 => 41,  113 => 40,  110 => 39,  107 => 38,  105 => 37,  98 => 35,  92 => 32,  79 => 24,  74 => 22,  70 => 21,  66 => 20,  50 => 9,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/userprofile/templates/profile-doctor-custom-template.html.twig", "C:\\xampp\\htdocs\\linqmd\\modules\\custom\\userprofile\\templates\\profile-doctor-custom-template.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "set" => 37, "for" => 41);
        static $filters = array("escape" => 9, "round" => 38, "raw" => 740);
        static $functions = array("range" => 41);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 'round', 'raw'],
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
