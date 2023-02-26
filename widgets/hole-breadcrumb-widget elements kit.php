<?php
namespace HOLEBreadcrumB\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;


// From elements kit


if (!defined('ABSPATH')){ exit; } // Exit if accessed directly

class HOLEBreadcrumBWidget extends Widget_Base{

    public function get_name(){
        return esc_html__('HoleBreadcrumb', 'hole-breadcrumb');
    }
    public function get_title(){
        return esc_html__('Hole Breadcrumb', 'hole-breadcrumb');
    }
    public function get_icon(){
        return 'holeb-breadcrumb-icon eicon-product-breadcrumbs';
    }
    public function get_categories(){
        return ['bwdthebest_general_category'];
    }
	public function get_keywords() {
		return ['breadcrumb', 'breadcrumbs', 'crumb', 'crumbs', 'list', 'header', 'builder'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ekit_lite_section_content',
			[
				'label' => __('Settings', 'hole-breadcrumb'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'ekit_breadcrumb_len',
			[
				'label'   => __('Max Title word length', 'hole-breadcrumb'),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 5,
				'max'     => 100,
				'step'    => 1,
				'default' => 15,
			]
		);
		$this->add_control(
			'ekit_breadcrumb_show_trail',
			[
				'label'        => __('Show category trail', 'hole-breadcrumb'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'hole-breadcrumb'),
				'label_off'    => __('Hide', 'hole-breadcrumb'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_section_breadcrumbs_style',
			[
				'label' => esc_html__('Style', 'hole-breadcrumb'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ekit_breadcrumb_text_color',
			[
				'label'     => esc_html__('Text Color', 'hole-breadcrumb'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .ekit-breadcrumb > li:not(.brd_sep)' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'ekit_breadcrumb_link_color',
			[
				'label'     => esc_html__('Link Color', 'hole-breadcrumb'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .ekit-breadcrumb > li > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ekit_breadcrumb_link_hover_color',
			[
				'label'     => esc_html__('Link Hover Color', 'hole-breadcrumb'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .ekit-breadcrumb > li > a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'ekit_breadcrumb_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'hole-breadcrumb'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .ekit-breadcrumb > li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'ekit_breadcrumb_typography',
				'selector'       => '{{WRAPPER}} .ekit-breadcrumb',
				'exclude'		 => ['text_decoration', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
						'default'    => [
							'size' => '',
							'unit' => 'px'
						],
						'label'      => 'Font size (px)',
						'size_units' => ['px'],
					],
					'font_weight'    => [
						'default' => '',
					],
					'text_transform' => [
						'default' => '',
					],
					'line_height'    => [
						'default' => [
							'size' => '',
							'unit' => 'px'
						]
					],
					'letter_spacing' => [
						'default' => [
							'size' => '',
						]
					],
				],
			]
		);
		$this->add_responsive_control(
			'ekit_breadcrumbs_alignment',
			[
				'label'     => esc_html__('Alignment', 'hole-breadcrumb'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'	=> [
						'title'		=> esc_html__('Left', 'hole-breadcrumb'),
						'icon'		=> 'eicon-text-align-left',
					],
					'center'	=> [
						'title' 	=> esc_html__('Center', 'hole-breadcrumb'),
						'icon'  	=> 'eicon-text-align-center',
					],
					'end'  => [
						'title' 	=> esc_html__('Right', 'hole-breadcrumb'),
						'icon'  	=> 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-breadcrumb' => 'justify-content: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'ekit_breadcrumb_space_between',
			[
				'label'      => esc_html__('Space In-between', 'hole-breadcrumb'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 5,
					'unit' => 'px'
				],
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .ekit-breadcrumb > li' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		echo '<div class="ekit-wid-con" >';
		$this->render_raw();
		echo '</div>';
	}

	protected function render_raw() {
		$settings = $this->get_settings_for_display();
		$pid      = get_the_ID();
		$max_len  = empty($settings['ekit_breadcrumb_len']) ? 15 : intval($settings['ekit_breadcrumb_len']);
		$trail    = !empty($settings['ekit_breadcrumb_show_trail']);
        $name_of_me = 'Ferdaus';
		echo $this->get_crumb($pid, $max_len, $trail);
	}

	private function get_crumb($post_id, $max_len, $trail = false, $sep = ' <li class="brd_sep"> &raquo; </li> ') {
		$ret = '<ol class="ekit-breadcrumb">';
		if(!is_home()){
			$ret .= '<li><a href="' . get_home_url('/') . '">' . __('Home', 'hole-breadcrumb') . '</a></li>';
			if(is_category() || is_single()){
				$category = get_the_category();
				if(!empty($category)){
					$cat = $category[0];
					$term_parent = $cat->parent;
					$taxonomy = $cat->taxonomy;
					$p_trail = '';
					if($trail === true) {
						if(0 !== $term_parent){
							while($term_parent){
								$term = get_term($term_parent, $taxonomy);
								$term_parent = $term->parent;
								$p_trail = $sep . '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>' . $p_trail;
							}
						}
					}
					$ret .= $p_trail . $sep . '<li><a href="' . get_category_link($cat->term_id) . '">' . $cat->cat_name . '</a></li>';
				} else {
					$p_type    = get_post_type($post_id);
					$post_type = get_post_type_object($p_type);
					if(!empty($post_type->labels->singular_name) && !in_array($post_type->name, ['post', 'page'])) {
						$ret .= $sep . '<li><a href="' . get_post_type_archive_link($p_type) . '">' . $post_type->labels->singular_name . '</a></li>';
					}
				}
				if(is_single()) {
					$ret .= $sep . '<li>' . wp_trim_words(get_the_title(), $max_len) . '</li>';
				}
			} elseif(is_page()) {
				$ret .= $sep . '<li>' . wp_trim_words(get_the_title(), $max_len) . '</li>';
			}
		}
		if(is_tag()) {
			$ret .= '<li>' . single_tag_title() . '</li>';
		} elseif(is_day()) {
			$ret .= '<li>' . esc_html__('Blogs for', 'hole-breadcrumb') . ' ' . get_the_time('F jS, Y', $post_id) . '</li>';
		} elseif(is_month()) {
			$ret .= '<li>' . esc_html__('Blogs for', 'hole-breadcrumb') . ' ' . get_the_time('F, Y', $post_id) . '</li>';
		} elseif(is_year()) {
			$ret .= '<li>' . esc_html__('Blogs for', 'hole-breadcrumb') . ' ' . get_the_time('Y', $post_id) . '</li>';
		} elseif(is_author()) {
			$ret .= '<li>' . esc_html__('Author Blogs', 'hole-breadcrumb') . '</li>';
		} elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {
			$ret .= '<li>' . esc_html__('Blogs', 'hole-breadcrumb') . '</li>';
		} elseif(is_search()) {
			//the_search_query()
			$ret .= '<li>' . esc_html__('Search Result', 'hole-breadcrumb') . '</li>';
		} elseif(is_404()) {
			$ret .= '<li>' . esc_html__('404 Not Found', 'hole-breadcrumb') . '</li>';
		}
		$ret .= '</ol>';
		return $ret;
	}
}
