@extends('layouts.app')

@section('content')


    <div class="py-5">

        <!--Section: Contact v.2-->
        <div class="container bg-white border rounded mb-4 px-5">

            <!--Section heading-->
            <h1 class="h1 font-weight-bold text-center my-4 pt-5">Contact Us</h1>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
                a matter of hours to help you.</p>

            <div class="row">

                <!--Grid column-->
                <div class="col-12 mb-md-0 mb-5">
                    {{-- <form id="contact-form" name="contact-form" action="mail.php" method="POST"> --}}

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-3">
                                    <label for="name" class="">Your name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-3">
                                    <label for="email" class="">Your email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-3">
                                    <label for="subject" class="">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form mb-3">
                                    <label for="message">Your message</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->

                    {{-- </form> --}}

                    <div class="text-center text-md-left mb-4 mt-2">
                        <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
                    </div>
                    <div class="status"></div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-12 text-center px-3 pb-5 pt-3">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <a class="text-decoration-none" href="https://goo.gl/maps/7zmq2MqtLABKscfy5" target="_blank" style="max-width: 320px;">
                                <i class="fas fa-map-marker-alt fa-2x my-2"></i>
                                <p>204, Laduba Tower, Station Road, Halol, Gujarat 389350, India</p>
                            </a>
                        </div>
                        <div class="col-12 col-md-4">
                            <a class="text-decoration-none" href="tel:+918806459472" style="max-width: 320px;">
                                <i class="fas fa-phone mt-4 fa-2x my-2"></i>
                                <p>+91 8806459472</p>
                            </a>
                        </div>
                        <div class="col-12 col-md-4">
                            <a class="text-decoration-none" href="mailto:support@eshopees.in" style="max-width: 320px;">
                                <i class="fas fa-envelope mt-4 fa-2x my-2"></i>
                                <p>support@eshopees.in</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Grid column-->

            </div>

            <div class="google-map mt-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d230.36915085722367!2d73.4781269!3d22.5076942!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39607f25a54aae2b%3A0x812a2b6a409e0e45!2sLaduba%20Tower!5e0!3m2!1sen!2sin!4v1678468450403!5m2!1sen!2sin" 
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
        <!--Section: Contact v.2-->
    </div>


@endsection
