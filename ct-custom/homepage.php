<?php
get_header(); 
?>

<main>
    <div class="breadcrumb-container">
        <ul>
            <li><a href="#" class="breadcrumb">Home</a></li>
            <li><a href="#" class="breadcrumb">Who We Are</a></li>
            <li><a href="#" class="breadcrumb active">Contact</a></li>
        </ul>
    </div>
    <div class="paragraph-container">
        <h2 class="title light-orange">Contact</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo minima mollitia dolorem tempora vel excepturi, cum, suscipit commodi repudiandae animi nisi harum alias nobis aliquam. Aperiam, placeat. At iusto praesentium dolore tempore harum voluptate officia!</p>
    </div>
    <div class="contact-container">
        <div class="right cols">
            <h2 class="title light-orange font-light">CONTACT US</h2>
            <div class="underline"></div>
            <div class="form-container">
                <form>
                    <input type="text" name="name" placeholder="Name *" required />
                    <input type="text" name="phone" placeholder="Phone * " required class="float-left" />
                    <input type="email" name="email" placeholder="Email *" required class="float-right" />
                    <textarea name="message" placeholder="Message *"></textarea>
                    <button class="btn">SUBMIT</button>
                </form>
            </div>
        </div>
        <div class="left cols">
            <h2 class="title light-orange font-light">REACH US</h2>
            <div class="underline"></div>
            <ul class="address">
                <li> Coalition Skills Test</li>
                <li>
                    <?php 
                        $address = esc_html(get_option('theme_address'));
						echo $address ? $address : '535 La Plata Street<br>4200 Argentina'; 
					?>
                </li>
                <li>
                    Phone: <?php $phone_number = esc_html(get_option('theme_phone_number')); echo $phone_number ? $phone_number : '385.154.11.28.35'; ?>
                    <br>
                    Fax: <?php $fax = esc_html(get_option('theme_fax_number')); echo $fax ? $fax : '385.154.35.66.78'; ?>
                </li>
            </ul>
            <ul class="social-out">
                <?php
                    $saved_links = get_option('theme_social_links', '');
                    
                    $fallback_links = array(
                        'facebook' => array(
                            'url' => 'https://www.facebook.com/',
                            'icon' => '<i class="fab fa-facebook-square"></i>'
                        ),
                        'twitter' => array(
                            'url' => 'https://www.x.com/',
                            'icon' => '<i class="fab fa-twitter-square"></i>'
                        ),
                        'linkedin' => array(
                            'url' => 'https://www.linkedin.com/',
                            'icon' => '<i class="fab fa-linkedin"></i>'
                        ),
                        'pinterest' => array(
                            'url' => 'https://www.pinterest.com/',
                            'icon' => '<i class="fab fa-pinterest-square"></i>'
                        ),
                    );

                    if (!empty($saved_links)) {
                        $social_links = explode(',', $saved_links); 
                        $social_keys = array_keys($fallback_links);

                        foreach ($social_links as $index => $link) {
                            $link = trim($link);
                            if (!empty($link) && isset($social_keys[$index])) {
                                $key = $social_keys[$index];
                                echo '<li><a href="' . esc_url($link) . '" target="_blank">' . $fallback_links[$key]['icon'] . '</a></li>';
                            }
                        }
                    } else {
                        foreach ($fallback_links as $item) {
                            echo '<li><a href="' . esc_url($item['url']) . '" target="_blank">' . $item['icon'] . '</a></li>';
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</main>

<?php get_footer(); ?>
