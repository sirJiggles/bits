<?php

/*
 * Footer
 * @author Gareth Fuller
 */
?>
        
        <!-- for sticky footer -->
        <div class="push"></div>
        
        </div>
        <!-- end site wrapper -->
        
        
        <div class="light-grey-row">
            <div class="row footer-row">
                <footer id="site-footer">

                    <div class="grid-12 end">

                         <a class="back-to-top" title="Click here to navigate to the top of the page" href="#">&#136;</a>

                         <div class="footer-left">
                            <p class="copy">&copy; Tyrrell &amp; Company Limited</p>
                            <p>Tyrrell and Company is a multi-award winning firm of business consultants and accountants based just outside Cambridge.</p>
                            <p>Suite D, South Cambridge Business Park, Babraham Road, Sawston, Cambridge, CB22 3JH</p>

                            <div class="clear">&nbsp;</div>
                            
                             <?php 
                                 wp_nav_menu(array(
                                    'menu'          => 'Footer Navigation',
                                    'container'     => false,
                                    'menu_class'    => false,
                                    'echo'          => true,
                                    'before'        => '',
                                    'after'         => '',
                                    'link_before'   => '',
                                    'link_after'    => '',
                                    'depth'         => 1
                                )); 
                            ?>
                        </div>

                        <div class="footer-right">
                            <a class="email" href="mailto:info@tyrrellandcompany.co.uk" title="email us at info@tyrrellandcompany.co.uk">info@tyrrellandcompany.co.uk</a>
                            <a class="tel" href="tel:01223832477" title="Call us on 01223 832 477">01223 832 477</a>

                            <ul class="social">
                                <li><a href="#" title="Add us on Google plus" class="icon-gplus"></a></li>
                                <li><a href="#" title="Add us on Facebook" class="icon-facebook"></a></li>
                                <li><a href="#" title="Follow us on Twitter" class="icon-twitter"></a></li>
                                <li><a href="#" title="Connect with us on LinkedIn" class="icon-linkedin"></a></li>
                            </ul>
                        </div>

                    </div>



                </footer>
            </div>
        </div>

        
        <?php wp_footer(); ?>
        
    </body>
</html>