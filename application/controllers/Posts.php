<?php


class Posts extends CI_Controller{
                //view
                public function index(){
                        $data['title'] = 'Latest Posts';
                        $data['posts'] = $this->post_model->get_posts();
    
                        $this->load->view('templates/header');
                        $this->load->view('posts/index', $data);
                        $this->load->view('templates/footer');
                }
                //view
                public function view($slug = NULL){

                        $data['post'] = $this->post_model->get_posts($slug);

                    if(empty($data['post'])){

                        show_404();
                    }
                        $data['title'] = $data['post']['title'];
                        $this->load->view('templates/header');
                        $this->load->view('posts/view', $data);
                        $this->load->view('templates/footer');
                }

                //create
                public function create(){
                    //check login
                    if (!$this->session->userdata('logged_in')){
                        redirect('users/login');

                    }
                    //vadenje na kategorii od bazata
                    $data['categories'] = $this->post_model->get_categories();
                        //naslov
                        $data['title'] = 'Create Posts';

                        //validacija na formata
                        $this->form_validation-> set_rules('title', 'Title', 'required');
                        $this->form_validation-> set_rules('body', 'Body', 'required');

                    if ($this->form_validation->run() === false){
                        $this->load->view('templates/header');
                        $this->load->view('posts/create', $data);
                        $this->load->view('templates/footer');

                        } else{
                            //upload image

                            //patekata kaj so odi
                            $config['upload_path'] = './assets/images/posts';
                            //dozvoleni tipoj
                            $config['allowed_types'] = 'gif|jpg|png';
                            //max golemina
                            $config['max_size'] = '2048';
                            //max sirina
                            $config['max_width'] = '2000';
                            //max visina
                            $config['max_height'] = '2000';

                            $this->load->library('upload', $config);

                            if (!$this->upload->do_upload()){
                                $errors = array('error'=> $this->upload->display_errors());
                                $post_image = 'noimage.jpg';

                                }else{

                                $data = array('upload_data' => $this->upload->data());
                                $post_image = $_FILES['userfile']['name'];

                            }

                            $this->post_model->create_post($post_image);
                        //set a message
                        $this->session->set_flashdata('post_created', 'your post has been created ');
                            redirect('posts');
                        }
                }
                //delete
                public function delete($id){
                    //check login
                    if (!$this->session->userdata('logged_in')){
                        redirect('users/login');

                    }
                        $this->post_model->delete_post($id);
                    $this->session->set_flashdata('post_deleted', 'your post has been deleted ');
                    redirect('posts');

                    redirect('posts');
                }

                //funkcija edit
                public function edit($slug){
                    //check login
                    if (!$this->session->userdata('logged_in')){
                        redirect('users/login');

                    }
                        $data['post'] = $this->post_model->get_posts($slug);
                    //check user
                    if ($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']){
                        redirect('posts');
                    }

                    $data['categories'] = $this->post_model->get_categories();

                    if(empty($data['post'])){
                        show_404();
                    }
                        $data['title'] = 'Edit Post';
                        $this->load->view('templates/header');
                        $this->load->view('posts/edit', $data);
                        $this->load->view('templates/footer');
                }

                    //update
                public function update(){
                    //check login
                    if (!$this->session->userdata('logged_in')){
                        redirect('users/login');

                    }
                        $this->post_model->update_post();
                    //set a message
                    $this->session->set_flashdata('post_updated', 'your post has been updated ');
                        redirect('posts');

                }




}























