<?php
class ControllerCommonHome extends Controller {

    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));



        if (isset($this->request->get['route'])) {
            $this->document->addLink($this->config->get('config_url'), 'canonical');
        }

        $data = $this->language->load('common/home');
        $data['template_name'] = $this->config->get('theme_default_directory') ? $this->config->get('theme_default_directory') : $this->config->get('config_template');
        //Current
        $data['theme_directory'] = $this->config->get('theme_default_directory') ? $this->config->get('theme_default_directory') : $this->config->get('config_template');


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->hook->getHook('controller/home/after', $data);
        $this->response->setOutput($this->load->view('common/home', $data));
    }

}