<?php
/**
 * ZenCMS Software
 * Author: ZenThang
 * Email: thangangle@yahoo.com
 * Website: http://zencms.vn or http://zenthang.com
 * License: http://zencms.vn/license or read more license.txt
 * Copyright: (C) 2012 - 2013 ZenCMS
 * All Rights Reserved.
 */
if (!defined('__ZEN_KEY_ACCESS')) exit('No direct script access allowed');

class marketController extends ZenController
{

    private $market = array();

    function index($request_data = array())
    {
        /**
         * load helpers
         */
        load_helper('time');
        load_helper('gadget');

        /**
         * load library
         */
        $security = load_library('security');
        $p = load_library('pagination');
        $bbcode = load_library('bbcode');
        $permission = load_library('permission');
        $permission->set_user($this->user);

        /**
         * get market model
         */
        $model = $this->model->get('market');

        if (isset($_GET['_review_recycleBin_']) && is(ROLE_MANAGER)) {

            $model->only_filter_recycle_bin();
        }

        /**
         * get hook
         */
        $this->hook->get('market');

        /**
         * remove sqli, load id *
         */
        if (isset($request_data[0])) {

            $id = $security->removeSQLI($request_data[0]);

        } else {

            $id = 0;
        }

        $id = (int)$id;

        /**
         * Check market is exists *
         */
        if ($model->market_exists($id) == false) {

            $data['page_title'] = 'Error!';
            $data['notices'][] = 'Bài đăng này không tôn tại hoặc đã bị xóa bời người quản lí!';
            $this->view->data = $data;
            $this->view->show('market/error');
            return false;
        }

        /**
         * If is a market *
         */
        $market_data = $model->get_market_data($id); // load data of market

        if (empty($market_data['parent'])) {

            $_SESSION['ss_url_delete_and_back'] = _HOME;

        } else {

            $data_back = $model->get_market_data($market_data['parent'], 'url');

            if (isset($data_back['full_url'])) {

                $_SESSION['ss_url_delete_and_back'] = $data_back['full_url'];
            }

        }

        $market_data['sid'] = $id;

        /**
         * load title market or home *
         */
        if (isset($market_data['title'])) {

            $data['page_title'] = $market_data['title'];

        } else {

            if (isset($market_data['name'])) {

                $data['page_title'] = $market_data['name'];

            } else {

                $data['page_title'] = get_config('title');
            }
        }

        /**
         * if $id = 0 is home
         */
        if ($id == 0) {

            $cats = $model->get_list_market(0);

            $limit_sub_cat = 0;

            /**
             * num_display_sub_cat_in_index hook *
             */
            $limit_sub_cat = $this->hook->loader('num_display_sub_cat_in_index', $limit_sub_cat);


            $order_sub_cat = array('weight' => 'ASC', 'time' => 'DESC');

            /**
             * order_display_sub_cat_in_index hook *
             */
            $order_sub_cat = $this->hook->loader('order_display_sub_cat_in_index', $order_sub_cat);

            $filter_sub_cat = NULL;

            /**
             * order_display_sub_cat_in_index hook *
             */
            $filter_sub_cat = $this->hook->loader('filter_display_sub_cat_in_index', $filter_sub_cat);

            foreach ($cats as $kid => $cat) {

                $cats[$kid]['sub_cat'] = $model->get_list_market($kid, $filter_sub_cat, $order_sub_cat, $limit_sub_cat);
            }

            /**
             * lists_in_index hook *
             */
            $data['list'] = $this->hook->loader('lists_in_index', $market_data, true);

            $data['page_keyword'] = get_config('keyword');
            $data['page_des'] = get_config('des');
            $data['cats'] = $cats;
            $this->view->data = $data;
            $this->view->show('market');
            return;
        }

        /**
         * update view
         */
        $model->update_view($market_data['sid']);

        /**
         * else is a market *
         */
        if ($market_data['type'] == 'folder') {
            /**
             * lists_in_folder hook *
             */
            $data['list'] = $this->hook->loader('lists_in_folder', $market_data, true);

            /**
             * load manager bar *
             */
            if ($permission->is_manager()) {

                $market_data['manager_bar'] = $this->hook->loader('folder_manager_bar', $id);

            } else {

                $market_data['manager_bar'] = array();
            }

            $data['page_more'] = '';
            /**
             * set_page_more_in_folder hook *
             */
            $data['page_more'] = $this->hook->loader('set_page_more_in_folder', $data['page_more']);

        } elseif ($market_data['type'] == 'post') {

            $data['page_more'] = '';
            /**
             * set_page_more_in_post hook *
             */
            $data['page_more'] = $this->hook->loader('set_page_more_in_post', $data['page_more']);

            $data['page_more'] .= gadget_TinymceEditer('bbcode_mini', true);

            /**
             * lists_in_post hook *
             */
            $data['list'] = $this->hook->loader('lists_in_post', $market_data, true);

            /**
             * load manager bar *
             */
            if ($permission->is_manager()) {

                $market_data['manager_bar'] = $this->hook->loader('post_manager_bar', $id);

            } else {

                $market_data['manager_bar'] = array();
            }

        } else {

            $data['page_title'] = 'Error!';
            $data['notices'][] = 'Bài đăng này đã bị xóa bời người quản lí!';
            /**
             * lists_in_other hook *
             */
            $data['list'] = $this->hook->loader('lists_in_other', $market_data, true);
            $this->view->data = $data;
            $this->view->show('market/error');
            return false;
        }


        /**
         * load content
         */
        if (isset($market_data['type_data']) && isset($market_data['content'])) {
            /**
             * out_content hook *
             */
            $market_data['content'] = $this->hook->loader('out_content', $market_data['content']);

            if ($market_data['type_data'] == 'bbcode') {

                $market_data['content'] = $bbcode->parse($market_data['content']);
                /**
                 * out_bbcode_content hook *
                 */
                $market_data['content'] = $this->hook->loader('out_bbcode_content', $market_data['content']);
            } else {
                /**
                 * out_html_content hook *
                 */
                $market_data['content'] = $this->hook->loader('out_html_content', $market_data['content']);
            }

            $market_data['content'] = scan_smiles($market_data['content']);
        }


        $tags = $model->get_tags_market($market_data['sid']);

        foreach ($tags as $tag) {

            /**
             * out_tag hook *
             */
            $market_data['tags'][] = $this->hook->loader('out_tag', $tag);

        }

        // start comments

        if (isset($_POST['sub_comment'])) {

            if ($security->check_token('token_comment')) {

                if (!$security->check_token('captcha_code') and empty($this->user['id'])) {

                    $data['errors'][] = 'Mã xác nhận không chính xác';
                } else {

                    $continous = true;

                    if (isset($this->user['id'])) {

                        $ins_cmt['uid'] = $this->user['id'];
                    } else {

                        $ins_cmt['uid'] = 0;
                    }

                    if (!$ins_cmt['uid']) {

                        if (empty($_POST['name'])) {

                            $data['notices'][] = 'Bạn chưa nhập tên mình';
                            $continous = false;

                        } else {

                            $ins_cmt['name'] = h($_POST['name']);
                        }
                    } else {

                        $ins_cmt['name'] = $this->user['username'];
                    }

                    if (empty($_POST['msg'])) {

                        $data['notices'][] = 'Nội dung comment không được để trống';
                        $continous = false;

                    } else {

                        $ins_cmt['msg'] = h($_POST['msg']);
                        /**
                         * in_msg_comment_content hook *
                         */
                        $ins_cmt['msg'] = $this->hook->loader('in_msg_comment_content', $ins_cmt['msg']);
                    }

                    if ($continous == true) {

                        $ins_cmt['sid'] = $market_data['sid'];
                        $ins_cmt['ip'] = client_ip();

                        $model->insert_comment($ins_cmt);
                    }
                }
            }
        }

        $limit = 5;
        /**
         * num_comment hook *
         */
        $limit = $this->hook->loader('num_comment', $limit);
        $p->setLimit($limit);
        $p->SetGetPage('cmtPage');
        $start = $p->getStart();
        $sql_limit = $start.','.$limit;

        $market_data['comments'] = $model->get_comments($market_data['sid'], $sql_limit);

        foreach ($market_data['comments'] as $_cmt_k => $_cmt) {

            $_cmt['msg'] = $bbcode->parse($_cmt['msg']);

            $_cmt['msg'] = scan_smiles($_cmt['msg']);
            /**
             * out_msg_comment_content hook *
             */
            $_cmt['msg'] = $this->hook->loader('out_msg_comment_content', $_cmt['msg']);

            $market_data['comments'][$_cmt_k]['msg'] = $_cmt['msg'];
        }

        $p->setTotal($model->total_result);

        $data['comments_pagination'] = $p->navi_page('?cmtPage={cmtPage}#comments');

        $data['token_comment'] = $security->get_token('token_comment');

        $captcha_security_key = $security->get_token('captcha_security_key', 4);
        $data['captcha_src'] = _HOME . '/captcha/image/image_' . $captcha_security_key . '.jpg';
        // end comments


        // start like and dislike
        if (isset($_GET['_t_'])) {

            if ($security->check_token('_t_', 'GET')) {

                if (isset ($this->user['id']) && !empty($this->user['id'])) {

                    $ldata['fromid'] = $this->user['id'];

                } else {

                    $ldata['ip'] = client_ip();
                }

                $ldata['toid'] = $market_data['sid'];

                if (isset($_GET['_like_'])) {

                    $model->do_like($ldata);

                } else {

                    if (isset($_GET['_dislike_'])) {

                        $model->do_dislike($ldata);
                    }
                }
                redirect($market_data['full_url']);
            }
        }
        // end like and dislike

        /**
         * like & dislike
         */
        $market_data['likes'] = $model->get_like($market_data['sid']);
        $market_data['dislikes'] = $model->get_dislike($market_data['sid']);

        /**
         * num_likes hook *
         */
        $market_data['likes'] = $this->hook->loader('num_likes', $market_data['likes']);

        /**
         * num_dislikes hook *
         */
        $market_data['dislikes'] = $this->hook->loader('num_dislikes', $market_data['dislikes']);

        $market_data['is_liked'] = $model->is_liked($market_data['sid']);
        $market_data['is_disliked'] = $model->is_disliked($market_data['sid']);

        /**
         * get like token
         */
        $token_like = $security->get_token('_t_');

        /**
         * set link like & dislike
         */
        $link_like = '<a href="' . $market_data['full_url'] . '?_like_&_t_=' . $token_like . '" title="Like">' . icon('like') . '</a>';
        $link_dislike = '<a href="' . $market_data['full_url'] . '?_dislike_&_t_=' . $token_like . '" title="Dislike">' . icon('dislike') . '</a>';

        if ($market_data['is_liked']) {

            $link_like = icon('like');
        }
        if ($market_data['is_disliked']) {

            $link_dislike = icon('dislike');
        }

        /**
         * hook link like, dislike
         */
        $market_data['link_like'] = $this->hook->loader('link_like', $link_like);
        $market_data['link_dislike'] = $this->hook->loader('link_dislike', $link_dislike);

        /**
         * get link and file download
         */
        $links = $model->get_links($market_data['sid']);
        $files = $model->get_files($market_data['sid']);

        /**
         * links_download hook & files_download hook*
         */
        $market_data['downloads']['links'] = $this->hook->loader('links_download', $links);
        $market_data['downloads']['files'] = $this->hook->loader('files_download', $files);

        if (empty($market_data['downloads']['links']) && empty($market_data['downloads']['files'])) {

            $market_data['downloads'] = array();

        }

        $data['market'] = $market_data;

        if (count($data['market']) && empty($data['market']['type_view'])) {

            $data['market']['type_view'] = 'default';
        }


        $this->market = $data['market'];

        $tree[] = url(_HOME, icon('home'), 'title="' . get_config('title') . '"');
        /**
         * first_market_path hook *
         */
        $tree = $this->hook->loader('first_market_path', $tree);

        /**
         * market_data hook *
         */
        $data['market'] = $this->hook->loader('market_data', $data['market']);

        $tree = array_merge($tree, $this->market_path($id));
        $data['display_tree'] = display_tree($tree);

        $data['page_keyword'] = $data['market']['keyword'];
        $data['page_des'] = $data['market']['des'];
        $data['page_url'] = $data['market']['full_url'];

        $this->view->data = $data;

        if ($data['market']['type']) {

            $this->view->show('market/' . $data['market']['type']);
            return;
        }

        $this->view->show('market');
    }

    public function manager($app = array('index'))
    {
        load_apps(__MODULES_PATH . '/market/apps/manager', $app);
    }

    private function market_path($id = 0, $from_recycle_bin = false)
    {
        static $tree = array();
        static $i;
        $i++;

        $model = $this->model->get('market');

        if ($from_recycle_bin == true) {

            $model->not_filter_recycle_bin(true);

        }

        $market = $model->get_market_data($id);

        if (!empty($market)) {

            if ($i != 1) {

                $tree[] = url($market['full_url'], $market['name'], 'title="' . $market['title'] . '"');
            }

            $parent = $market['parent'];

            $this->market_path($parent);

        } else {


            $tree = array_reverse ($tree);
        }
        return $tree;
    }



}