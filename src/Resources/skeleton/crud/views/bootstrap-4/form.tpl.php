<?php if ($is_modal): ?>
{% extends '@CoreUI/modal_layout.html.twig' %}

{% block title %}
    {{ title|trans }} {{ '<?= strtolower($entity_class_name) ?>'|trans }}
{% endblock %}

{% block body %}
    
    {{ form_widget(form) }}
        
{% endblock %} 

{% block form_start %}
    {{ form_start(form) }}
{% endblock %}

{% block form_end %}
    {{ form_end(form) }}
{% endblock %}

{% block actions %}
    {{ include('@CoreUI/_submit.twig') }}
{% endblock %}
  
<?php else: ?>
{% extends "@CoreUI/page_layout.html.twig" %}

{% block page_title %}
    {{ title|trans }}: {{ '<?= strtolower($entity_class_name) ?>'|trans }}
{% endblock %}

{% block page_actions %}
    {{ include('@CoreUI/_submit.twig') }}
    {{ link_to('<?= $route_name ?>_index', {}, { class:"btn btn-sm btn-outline-primary", label: 'back'|trans, icon: '<span class="bi-backspace"></span>' }) }}
{% endblock %}

{% block form_start %}
    {{ form_start(form) }}
{% endblock %} 

{% block page %}
        
    {{ form_widget(form) }}
    
{% endblock %} 

{% block form_end %}
    {{ form_end(form) }}
{% endblock %}
<?php endif ?>