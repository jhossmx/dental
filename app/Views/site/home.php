<?php $this->extend('layout/site') ?>
<?php $session = \Config\Services::session(); ?>

<?php $this->section('content') ?>
    <!-- Carousel Start -->
    <?php echo $this->include('layout/site/carousel'); ?>
    <!-- Carousel End -->

    <!-- Banner Start -->
    <?php echo $this->include('layout/site/banner'); ?>
    <!-- Banner Start -->

    <!-- About Start -->
    <?php echo $this->include('layout/site/about'); ?>
    <!-- About End -->

    <!-- Appointment Start -->
    <?php echo $this->include('layout/site/appointment'); ?>
    <!-- Appointment End -->

    <!-- Service Start -->
    <?php echo $this->include('layout/site/services'); ?>
    <!-- Service End -->

    <!-- Offer Start -->
    <?php echo $this->include('layout/site/specials'); ?>
    <!-- Offer End -->

    <!-- Pricing Start -->
    <?php echo $this->include('layout/site/prices'); ?>
    <!-- Pricing End -->

    <!-- Testimonial Start -->
    <?php echo $this->include('layout/site/testimonials'); ?>
    <!-- Testimonial End -->

    <!-- Team Start -->
    <?php echo $this->include('layout/site/team'); ?>
    <!-- Team End -->

    <!-- Newsletter Start -->
    <?php echo $this->include('layout/site/newsletter'); ?>
    <!-- Newsletter End -->

<?php $this->endSection() ?>