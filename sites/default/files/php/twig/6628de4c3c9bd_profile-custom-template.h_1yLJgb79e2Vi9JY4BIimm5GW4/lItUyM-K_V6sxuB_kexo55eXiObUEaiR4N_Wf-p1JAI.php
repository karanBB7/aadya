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
        echo "<section id=\"sec1\">
\t<div class=\"container-fluid\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-lg-4 offset-lg-1 col-md-5 order-lg-2 order-sm-2 img-bg\">
\t\t\t\t<img class=\"img-fluid float-end docimg\" src=\"";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 5), "field_background_image", [], "any", false, false, true, 5), "url", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
        echo "\" alt=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 5), "field_background_image", [], "any", false, false, true, 5), "alt", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
        echo "\">
\t\t\t</div>
\t\t\t<div class=\"svg d-block d-sm-none\">
\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\">
\t\t\t\t\t<path fill=\"#4c94d3\" fill-opacity=\"1\" d=\"M0,128L80,144C160,160,320,192,480,197.3C640,203,800,181,960,149.3C1120,117,1280,75,1360,53.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z\"></path>
\t\t\t\t</svg>
\t\t\t</div>
\t\t\t<div class=\"col-lg-7 col-md-7 intro-box order-lg-1 order-sm-1\">
\t\t\t\t<h1 class=\"fs-1 tc\">";
        // line 13
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 13), "field_name", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
        echo "</h1>
\t\t\t\t<p class=\"title tc\">";
        // line 14
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 14), "field_speciality", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
        echo " </p>
\t\t\t\t<p style=\"margin-top: -10px;\" class=\"tc\">";
        // line 15
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 15), "field_degree", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
        echo " </p>
\t\t\t\t<div class=\"d-block d-sm-none\" style=\"margin-top: -20px;\">
\t\t\t\t\t<p class=\"pt-4 fs-4 m-3 tc\">";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 17), "field_phone_number", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 17), "field_email_address", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
        echo "</p>
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-sm-7 bg-change\">
\t\t\t\t\t\t<div class=\"sm-fl\">
\t\t\t\t\t\t\t<button class=\"btn appbtn rounded-pill mb-2 order-lg-2 order-sm-2\">Make an appointment</button>
\t\t\t\t\t\t\t<button class=\"whatsappbtn btn mb-2 d-block d-sm-none\"><span><i class=\"fa-brands fa-whatsapp mx-1\"></i> </span> <span class=\"line\"></span> <span class=\"mx-2 fw-bolder\">SHARE</span></button>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<p class=\"pt-4 fs-6 mb-4 d-none d-sm-block\">";
        // line 25
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 25), "field_phone_number", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
        echo " <br>";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 25), "field_email_address", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
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
        // line 36
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 36), "field_experiences", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
        echo " Years</span></p>
\t\t\t\t\t\t<p class=\"fs-5 fw-bold mx-1 mb-4\" style=\"margin-top: -30px;\"><span class=\"ex\">Experience</span></p>
\t\t\t\t\t\t<p class=\"exp mb-4\"><span class=\"ten\">";
        // line 38
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 38), "field_patients", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
        echo "</span> Patients</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"sm-fl bg-change d-flex\">
\t\t\t\t\t\t";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 41), "field_logos", [], "any", false, false, true, 41));
        foreach ($context['_seq'] as $context["key"] => $context["imgdata"]) {
            // line 42
            echo "\t\t\t\t\t\t\t<div class=\"col-sm-4 mt-2 mb-2 m-2\">
\t\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"";
            // line 43
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["imgdata"], "field_logo", [], "any", false, false, true, 43), "url", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
            echo "\" alt=\"\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['imgdata'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</section>


\t<section id=\"sec2\" class=\"pt-5 pb-5\">
\t\t<div class=\"container\">
\t\t\t<ul class=\"nav nav-pills \" role=\"tablist\">
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link active fw-bold\" data-bs-toggle=\"pill\" href=\"#overview\">Overview</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#speciality\">Speciality</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#summary\">Expertise summary</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#practise\">Places of practise</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t<a class=\"nav-link fw-bold\" data-bs-toggle=\"pill\" href=\"#meet\">First available time to meet </a>
\t\t\t\t</li>
\t\t\t</ul>
\t\t</div>

\t\t<div class=\"container\">
\t\t\t<div class=\"tab-content\">

\t\t\t\t<div id=\"overview\" class=\"container tab-pane active pt-4\"><br>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-7 col-sm-7 pilltext\">
\t\t\t\t\t\t\t<p>";
        // line 81
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 81), "field_overview", [], "any", false, false, true, 81), 81, $this->source), "html", null, true);
        echo "</p>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t";
        // line 84
        echo "\t\t\t\t\t\t\t<h2><b>Education</b></h2>
\t\t\t\t\t\t\t<p>";
        // line 85
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 85), "field_allcertifications", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
        echo "</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-5 col-sm-5\">
\t\t\t\t\t\t\t<img class=\"img-fluid\" alt=\"\" src=\"";
        // line 88
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 88), "field_background_image", [], "any", false, false, true, 88), "url", [], "any", false, false, true, 88), 88, $this->source), "html", null, true);
        echo "\" alt=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 88), "field_background_image", [], "any", false, false, true, 88), "alt", [], "any", false, false, true, 88), 88, $this->source), "html", null, true);
        echo "\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t</div>

\t\t\t\t<div id=\"speciality\" class=\"container tab-pane fade pt-4\"><br>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-7 col-sm-7 pilltext\">
\t\t\t\t\t\t\t<p>";
        // line 97
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 97), "field_specialities", [], "any", false, false, true, 97), 97, $this->source), "html", null, true);
        echo "</p>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-5 col-sm-5\">
\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"assets/img/docvid.png\" alt=\"\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"summary\" class=\"container tab-pane fade pt-4\"><br>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-7 col-sm-7 pilltext\">
\t\t\t\t\t\t\t<p>As SANA Medical Center President and CMO since 1997, Scott Riley is an
\t\t\t\t\t\t\t\tactive member in the San Diego County community. He currently serves
\t\t\t\t\t\t\t\tas the Vice Chair of the Board of Directors for the San Diego Council of
\t\t\t\t\t\t\t\tClinics, a board member of the North San Diego Economic Council, San
\t\t\t\t\t\t\t\tDiegans for Healthcare Coverage, the Blue Shield/UCSF Clinical Leadership
\t\t\t\t\t\t\t\tInstitute, The San Diego Regional Climate Education Partnership, CSUSM
\t\t\t\t\t\t\t\tUniversity Council and the Palomar College President’s Circle. </p>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<p>Mr. Riley ha</p>
\t\t\t\t\t\t\t<b>Education </b>
\t\t\t\t\t\t\t<p>Perelman School of Medicine at the University of Pennsylvania (1987)</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-5 col-sm-5\">
\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"assets/img/docvid.png\" alt=\"\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"practise\" class=\"container tab-pane fade pt-4\"><br>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-7 col-sm-7 pilltext\">
\t\t\t\t\t\t\t<p>As SANA Medical Center President and CMO since 1997, Scott Riley is an
\t\t\t\t\t\t\t\tactive member in the San Diego County community. He currently serves
\t\t\t\t\t\t\t\tas the Vice Chair of the Board of Directors for the San Diego Council of
\t\t\t\t\t\t\t\tClinics, a board member of the North San Diego Economic Council, San
\t\t\t\t\t\t\t\tDiegans for Healthcare Coverage, the Blue Shield/UCSF Clinical Leadership
\t\t\t\t\t\t\t\tInstitute, The San Diego Regional Climate Education Partnership, CSUSM
\t\t\t\t\t\t\t\tUniversity Council and the Palomar College President’s Circle. </p>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<p>Mr. Riley ha</p>
\t\t\t\t\t\t\t<b>Education </b>
\t\t\t\t\t\t\t<p>Perelman School of Medicine at the University of Pennsylvania (1987)</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-5 col-sm-5\">
\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"assets/img/docvid.png\" alt=\"\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"meet\" class=\"container tab-pane fade pt-4\"><br>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-7 col-sm-7 pilltext\">
\t\t\t\t\t\t\t<p>As SANA Medical Center President and CMO since 1997, Scott Riley is an
\t\t\t\t\t\t\t\tactive member in the San Diego County community. He currently serves
\t\t\t\t\t\t\t\tas the Vice Chair of the Board of Directors for the San Diego Council of
\t\t\t\t\t\t\t\tClinics, a board member of the North San Diego Economic Council, San
\t\t\t\t\t\t\t\tDiegans for Healthcare Coverage, the Blue Shield/UCSF Clinical Leadership
\t\t\t\t\t\t\t\tInstitute, The San Diego Regional Climate Education Partnership, CSUSM
\t\t\t\t\t\t\t\tUniversity Council and the Palomar College President’s Circle. </p>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<p>Mr. Riley ha</p>
\t\t\t\t\t\t\t<b>Education </b>
\t\t\t\t\t\t\t<p>Perelman School of Medicine at the University of Pennsylvania (1987)</p>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-5 col-sm-5\">
\t\t\t\t\t\t\t<img class=\"img-fluid\" src=\"assets/img/docvid.png\" alt=\"\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>

\t\t<div class=\"container mt-4\">
\t\t\t<div class=\"owl-carousel docslider\">
\t\t\t";
        // line 174
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 174), "field_youtube", [], "any", false, false, true, 174));
        foreach ($context['_seq'] as $context["key"] => $context["url"]) {
            echo "\t\t\t\t
\t\t\t\t<iframe src=\"";
            // line 175
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["url"], "field_youtube_embede", [], "any", false, false, true, 175), 175, $this->source), "html", null, true);
            echo "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>

\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['url'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 178
        echo "\t\t\t\t
\t\t\t\t";
        // line 183
        echo "\t\t\t</div>
\t\t</div>
\t</section>


\t<section id=\"sec3\" class=\"p-5 pb-0\">
\t\t<div class=\"container\">
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


\t\t\t<div id=\"brain\" class=\"container tab-pane active\"><br>
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


\t\t\t\t<div class=\"row pt-5 d-flex\">
\t\t\t\t\t<div class=\"\">
\t\t\t\t\t\t<i class=\"fa-solid fa-location-dot fs-1\"></i>
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

\t\t\t<div id=\"spine\" class=\"container tab-pane fade\"><br>
\t\t\t\t<div class=\"col-sm-7\">
\t\t\t\t\t<h3>Spine</h3>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div id=\"medical\" class=\"container tab-pane fade\"><br>
\t\t\t\t<div class=\"col-sm-7\">
\t\t\t\t\t<h3>Medical</h3>
\t\t\t\t</div>
\t\t\t</div>


\t\t</div>
\t</section>

\t<section id=\"sec4\" class=\"pt-0\">
\t\t<div class=\"container\">
\t\t\t<div class=\"row p-2\">
\t\t\t\t<h2 class=\"col-lg-9\">Areas of expertise</h2>
\t\t\t\t<button class=\"btn mx-end col-lg-3 facilities\">View All Speciality Facilities</button>
\t\t\t</div>
\t\t\t<div class=\"row pt-5 sm-hide\">




";
        // line 340
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 340), "field_areaofexpertise", [], "any", false, false, true, 340));
        foreach ($context['_seq'] as $context["key"] => $context["data"]) {
            // line 341
            echo "\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t\t<img src=\"";
            // line 343
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["data"], "field_logoexpertise", [], "any", false, false, true, 343), "url", [], "any", false, false, true, 343), 343, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["expimg"] ?? null), "field_logoexpertise", [], "any", false, false, true, 343), "alt", [], "any", false, false, true, 343), 343, $this->source), "html", null, true);
            echo "\" width=\"100%\">
\t\t\t\t\t</div>
\t\t\t\t\t<h6 class=\"text-center p-3\"><b>";
            // line 345
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisehead", [], "any", false, false, true, 345), 345, $this->source), "html", null, true);
            echo "</b></h6>
\t\t\t\t\t<div class=\"text-center\">
\t\t\t\t\t\t";
            // line 347
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisecontent", [], "any", false, false, true, 347), 347, $this->source), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</div>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 352
        echo "

\t\t\t</div>

";
        // line 357
        echo "
\t\t\t<div class=\"owl-carousel expslider d-block d-sm-none pt-5\">

";
        // line 360
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 360), "field_areaofexpertise", [], "any", false, false, true, 360));
        foreach ($context['_seq'] as $context["key"] => $context["data"]) {
            // line 361
            echo "\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 p-5\">
\t\t\t\t\t<div class=\"col-sm-4 mx-auto\">
\t\t\t\t\t\t<img src=\"";
            // line 363
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["data"], "field_logoexpertise", [], "any", false, false, true, 363), "url", [], "any", false, false, true, 363), 363, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["expimg"] ?? null), "field_logoexpertise", [], "any", false, false, true, 363), "alt", [], "any", false, false, true, 363), 363, $this->source), "html", null, true);
            echo "\" class=\"mx-auto\" style=\"width:50% !important;\">
\t\t\t\t\t</div>

\t\t\t\t\t<h6 class=\"text-center p-3\"><b>";
            // line 366
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisehead", [], "any", false, false, true, 366), 366, $this->source), "html", null, true);
            echo "</b></h6>
\t\t\t\t\t<div class=\"text-center\">";
            // line 367
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["data"], "field_expertisecontent", [], "any", false, false, true, 367), 367, $this->source), "html", null, true);
            echo "</div>
\t\t\t\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 370
        echo "

\t\t\t</div>
\t\t</div>
\t</section>

\t<section id=\"sec5\" class=\"\">
\t\t<h2 class=\"text-center\">Latest News & Articles</h2>
\t\t<div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-12 search-wrapper p-3\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-sm-12 col-md-12\">
\t\t\t\t\t\t\t<div class=\"d-flex\">
\t\t\t\t\t\t\t\t<input class=\"form-control flex-grow-1 p-3\" type=\"search\" placeholder=\"Search for news\">
\t\t\t\t\t\t\t\t<button class=\"searchBtn p-3 ml-2\">Search</button>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-sm-12 col-md-12 mt-3 mt-md-0\">
\t\t\t\t\t\t\t<div class=\"tags text-white d-flex flex-wrap\">
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">All</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Article Long </p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Read</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Video</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Opinion</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Interview</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Explainer</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">First</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Person</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Exclusive</p>
\t\t\t\t\t\t\t\t<p class=\"mx-2 my-1\">Investigation</p>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<h5 class=\"p-3\">6 Results</h5>


\t\t\t\t<div class=\"row sm-hide\">

\t\t\t\t
\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 mb-3\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"assets/img/article1.png\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By Matthew Reyes </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">4 October, 2022</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>Having overweight and depression can</b></h6>
\t\t\t\t\t\t\t\t<div>Lorem ipsum dolor sit amet,
\t\t\t\t\t\t\t\t\tconsectetur adipiscing elit, sed do
\t\t\t\t\t\t\t\t\teiusmod tempor incididunt ut labore
\t\t\t\t\t\t\t\t\tet dolore magna...
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t
\t
\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4 mb-3\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"assets/img/article2.png\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By Matthew Reyes </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">4 October, 2022</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>Having overweight and depression can</b></h6>
\t\t\t\t\t\t\t\t<div>Lorem ipsum dolor sit amet,
\t\t\t\t\t\t\t\t\tconsectetur adipiscing elit, sed do
\t\t\t\t\t\t\t\t\teiusmod tempor incididunt ut labore
\t\t\t\t\t\t\t\t\tet dolore magna...
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t
\t
\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"assets/img/article3.png\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By Matthew Reyes </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">4 October, 2022</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>Having overweight and depression can</b></h6>
\t\t\t\t\t\t\t\t<div>Lorem ipsum dolor sit amet,
\t\t\t\t\t\t\t\t\tconsectetur adipiscing elit, sed do
\t\t\t\t\t\t\t\t\teiusmod tempor incididunt ut labore
\t\t\t\t\t\t\t\t\tet dolore magna...
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

";
        // line 478
        echo "
\t\t\t\t<div class=\"owl-carousel blogslider d-block d-sm-none\">
\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"assets/img/article1.png\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By Matthew Reyes </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">4 October, 2022</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>Having overweight and depression can</b></h6>
\t\t\t\t\t\t\t\t<div>Lorem ipsum dolor sit amet,
\t\t\t\t\t\t\t\t\tconsectetur adipiscing elit, sed do
\t\t\t\t\t\t\t\t\teiusmod tempor incididunt ut labore
\t\t\t\t\t\t\t\t\tet dolore magna...
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t
\t
\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"assets/img/article2.png\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By Matthew Reyes </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">4 October, 2022</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>Having overweight and depression can</b></h6>
\t\t\t\t\t\t\t\t<div>Lorem ipsum dolor sit amet,
\t\t\t\t\t\t\t\t\tconsectetur adipiscing elit, sed do
\t\t\t\t\t\t\t\t\teiusmod tempor incididunt ut labore
\t\t\t\t\t\t\t\t\tet dolore magna...
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t
\t
\t\t\t\t\t<div class=\"col-lg-4 col-md-6 col-sm-4\">
\t\t\t\t\t\t<div class=\"articele-wrapper pb-5\">
\t\t\t\t\t\t\t<img src=\"assets/img/article3.png\" width=\"100%\">
\t\t\t\t\t\t\t<div class=\"d-flex mx-4 mt-2\">
\t\t\t\t\t\t\t\t<div class=\"offset-lg-0\">By Matthew Reyes </div>
\t\t\t\t\t\t\t\t<div class=\"offset-lg-1\">4 October, 2022</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"p-4 pt-0\">
\t
\t\t\t\t\t\t\t\t<h6 class=\"pt-3 \"><b>Having overweight and depression can</b></h6>
\t\t\t\t\t\t\t\t<div>Lorem ipsum dolor sit amet,
\t\t\t\t\t\t\t\t\tconsectetur adipiscing elit, sed do
\t\t\t\t\t\t\t\t\teiusmod tempor incididunt ut labore
\t\t\t\t\t\t\t\t\tet dolore magna...
\t\t\t\t\t\t\t\t\t<button class=\"readMore p-2 float-start col-sm-7 mt-3\">Read More</button>
\t\t\t\t\t\t\t\t</div>
\t
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t</div>

\t\t</div>
\t</section>



\t<section id=\"sec6\" class=\"p-2\">
\t\t<div class=\"container\">
\t\t\t<p class=\"text-center fs-5 pt-5\">Patient Experience</p>
\t\t\t<h2 class=\"text-center pb-4\">What patients say about the doctor</h2>
\t\t\t<div class=\"col-sm-12 border border-dark-subtle rounded p-4\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<input type=\"search\" class=\"p-3 col-sm-9\" placeholder=\"Patient Experience\">
\t\t\t\t\t<div class=\"col-sm-3 d-flex\"> <span class=\"pt-3\">Sort By: </span>
\t\t\t\t\t\t<div class=\"dropdown mx-2\">
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn p-3 dropdown-toggle border border-dark-subtle\" data-bs-toggle=\"dropdown\">
\t\t\t\t\t\t\t\tMost Recent
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\">Normal</a></li>
\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item active\" href=\"#\">Active</a></li>
\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item disabled\" href=\"#\">Disabled</a></li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-sm-12 border border-dark-subtle rounded mt-5 pb-3 pt-3\">
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Patient Experiences</button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks</button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy </button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\"> cancer and tumors</button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\"> craniosynostosis</button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Reviews </button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks </button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
\t\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"row sm-hide\">

";
        // line 592
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 592), "field_testimonials", [], "any", false, false, true, 592));
        foreach ($context['_seq'] as $context["key"] => $context["testimonials"]) {
            // line 593
            echo "
\t\t\t\t<div class=\"col-sm-6 p-4\">
\t\t\t\t\t<div class=\"test-wrapp\">
\t\t\t\t\t\t<div class=\"p-3\">
\t\t\t\t\t\t\t<div class=\"quotes\">\"</div>
\t\t\t\t\t\t\t<h4><b>";
            // line 598
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_head", [], "any", false, false, true, 598), 598, $this->source), "html", null, true);
            echo "</b></h4>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<p class=\"text-black\">";
            // line 600
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_content", [], "any", false, false, true, 600), 600, $this->source), "html", null, true);
            echo "</p>
\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t<img src=\"";
            // line 603
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 603), "url", [], "any", false, false, true, 603), 603, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 603), "alt", [], "any", false, false, true, 603), 603, $this->source), "html", null, true);
            echo "\" class=\"pt-2 img-fluid d-block mx-auto\">
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-6 pt-2\">
\t\t\t\t\t\t\t\t\t<div class=\"fw-bolder\">";
            // line 606
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_patienname", [], "any", false, false, true, 606), 606, $this->source), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Aneurysm</button>
\t\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Hedeche</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['testimonials'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 616
        echo "
\t\t\t</div>

";
        // line 620
        echo "
\t\t\t<div class=\"row owl-carousel testimonial-slider d-block d-sm-none\">

\t\t\t";
        // line 623
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["arr_data"] ?? null), "profile_theme1", [], "any", false, false, true, 623), "field_testimonials", [], "any", false, false, true, 623));
        foreach ($context['_seq'] as $context["key"] => $context["testimonials"]) {
            // line 624
            echo "\t\t\t\t<div class=\"col-sm-6 p-4\">
\t\t\t\t\t<div class=\"test-wrapp\">
\t\t\t\t\t\t<div class=\"p-3\">
\t\t\t\t\t\t\t<div class=\"quotes\">\"</div>
\t\t\t\t\t\t\t<b>";
            // line 628
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_head", [], "any", false, false, true, 628), 628, $this->source), "html", null, true);
            echo "</b><br>
\t\t\t\t\t\t\t";
            // line 629
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_content", [], "any", false, false, true, 629), 629, $this->source), "html", null, true);
            echo "

\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-3\">
\t\t\t\t\t\t\t\t\t<img src=\"";
            // line 633
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 633), "url", [], "any", false, false, true, 633), 633, $this->source), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_image", [], "any", false, false, true, 633), "alt", [], "any", false, false, true, 633), 633, $this->source), "html", null, true);
            echo "\" class=\"pt-2 timg img-fluid d-block mx-auto\">
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-6 pt-2\">
\t\t\t\t\t\t\t\t\t<div class=\"fw-bolder\">";
            // line 636
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["testimonials"], "field_patienname", [], "any", false, false, true, 636), 636, $this->source), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Aneurysm</button>
\t\t\t\t\t\t\t\t\t<button class=\"rel-btn p-2 m-2 btn\">Hedeche</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['testimonials'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 646
        echo "
\t\t\t</div>


\t\t</div>
\t</section>

\t<section id=\"sec7\" class=\"pt-5 pb-5\">
\t\t<div class=\"container\">
\t\t\t<h2 class=\"text-center pb-5\">Frequently Asked Questions</h2>

\t\t\t<div class=\"col-sm-12 border border-dark-subtle rounded p-4\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<input type=\"search\" class=\"p-3 col-sm-9\" placeholder=\"Search For Answers\">
\t\t\t\t\t<div class=\"col-sm-3 d-flex\"> <span class=\"pt-3\">Sort By: </span>
\t\t\t\t\t\t<div class=\"dropdown mx-2\">
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn p-3 dropdown-toggle border border-dark-subtle\" data-bs-toggle=\"dropdown\">
\t\t\t\t\t\t\t\tMost Recent
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item\" href=\"#\">Normal</a></li>
\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item active\" href=\"#\">Active</a></li>
\t\t\t\t\t\t\t\t<li><a class=\"dropdown-item disabled\" href=\"#\">Disabled</a></li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>


\t\t\t<div class=\"col-sm-12 border border-dark-subtle rounded p-3 mt-5\">
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Patient Experiences</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks </button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">All Reviews</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">brain checks</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">proton therapy</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">cancer and tumors</button>
\t\t\t\t<button class=\"exp rounded-pill p-3 me-4 mt-3\">craniosynostosis</button>

\t\t\t</div>



\t\t\t<div class=\"container pt-5\">
\t\t\t\t<div class=\"accordion\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t
\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 mb-4\">
\t\t\t\t\t\t\t<article class=\"accordion-item rounded\">
\t\t\t\t\t\t\t\t<span class=\"accordion-label\">01. What are Dr. Hedley Top areas of Expertise?</span>
\t\t\t\t\t\t\t\t<div class=\"accordion-content\">
\t\t\t\t\t\t\t\t\t<p>If you want to cancel or change an order, you should contact the company or organization from which you made the purchase as soon as possible. This can usually be done through their customer service department. Be prepared to provide them with your order number and any other relevant information they may need to identify your order.</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</article>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 mb-4\">
\t\t\t\t\t\t\t<article class=\"accordion-item rounded\">
\t\t\t\t\t\t\t\t<span class=\"accordion-label\">02. Can i use my Insurance at Dr. Hedley ?</span>
\t\t\t\t\t\t\t\t<div class=\"accordion-content\">
\t\t\t\t\t\t\t\t\t<p>If you want to cancel or change an order, you should contact the company or organization from which you made the purchase as soon as possible. This can usually be done through their customer service department. Be prepared to provide them with your order number and any other relevant information they may need to identify your order.</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</article>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 mb-4\">
\t\t\t\t\t\t\t<article class=\"accordion-item rounded\">
\t\t\t\t\t\t\t\t<span class=\"accordion-label\">03. What are Dr. Hedley Top areas of Expertise?</span>
\t\t\t\t\t\t\t\t<div class=\"accordion-content\">
\t\t\t\t\t\t\t\t\t<p>If you want to cancel or change an order, you should contact the company or organization from which you made the purchase as soon as possible. This can usually be done through their customer service department. Be prepared to provide them with your order number and any other relevant information they may need to identify your order.</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</article>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 mb-4\">
\t\t\t\t\t\t\t<article class=\"accordion-item rounded\">
\t\t\t\t\t\t\t\t<span class=\"accordion-label\">04. Can i use my Insurance at Dr. Hedley ?</span>
\t\t\t\t\t\t\t\t<div class=\"accordion-content\">
\t\t\t\t\t\t\t\t\t<p>If you want to cancel or change an order, you should contact the company or organization from which you made the purchase as soon as possible. This can usually be done through their customer service department. Be prepared to provide them with your order number and any other relevant information they may need to identify your order.</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</article>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 mb-4\">
\t\t\t\t\t\t\t<article class=\"accordion-item rounded\">
\t\t\t\t\t\t\t\t<span class=\"accordion-label\">05. What are Dr. Hedley Top areas of Expertise?</span>
\t\t\t\t\t\t\t\t<div class=\"accordion-content\">
\t\t\t\t\t\t\t\t\t<p>If you want to cancel or change an order, you should contact the company or organization from which you made the purchase as soon as possible. This can usually be done through their customer service department. Be prepared to provide them with your order number and any other relevant information they may need to identify your order.</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</article>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 mb-4\">
\t\t\t\t\t\t\t<article class=\"accordion-item rounded\">
\t\t\t\t\t\t\t\t<span class=\"accordion-label\">06. Can i use my Insurance at Dr. Hedley ?</span>
\t\t\t\t\t\t\t\t<div class=\"accordion-content\">
\t\t\t\t\t\t\t\t\t<p>If you want to cancel or change an order, you should contact the company or organization from which you made the purchase as soon as possible. This can usually be done through their customer service department. Be prepared to provide them with your order number and any other relevant information they may need to identify your order.</p>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</article>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t</div>

\t</section>


\t<div class=\"pt-3\">
\t\t<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15555.80884571165!2d77.59631594999999!3d12.91079305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1712128342123!5m2!1sen!2sin\" class=\"map\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>
\t</div>

\t<script src=\"assets/js/main.js\"></script>
\t<script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js\"></script>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["arr_data", "expimg"]);    }

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
        return array (  846 => 646,  830 => 636,  822 => 633,  815 => 629,  811 => 628,  805 => 624,  801 => 623,  796 => 620,  791 => 616,  775 => 606,  767 => 603,  761 => 600,  756 => 598,  749 => 593,  745 => 592,  629 => 478,  520 => 370,  511 => 367,  507 => 366,  499 => 363,  495 => 361,  491 => 360,  486 => 357,  480 => 352,  469 => 347,  464 => 345,  457 => 343,  453 => 341,  449 => 340,  290 => 183,  287 => 178,  278 => 175,  272 => 174,  192 => 97,  178 => 88,  172 => 85,  169 => 84,  164 => 81,  127 => 46,  118 => 43,  115 => 42,  111 => 41,  105 => 38,  100 => 36,  84 => 25,  71 => 17,  66 => 15,  62 => 14,  58 => 13,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/userprofile/templates/profile-custom-template.html.twig", "C:\\xampp\\htdocs\\linqmd\\modules\\custom\\userprofile\\templates\\profile-custom-template.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 41);
        static $filters = array("escape" => 5);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
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
