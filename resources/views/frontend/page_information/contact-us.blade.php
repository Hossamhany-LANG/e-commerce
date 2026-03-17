@extends('layouts.app')
@section('title', 'Our Informations')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title"><b>Contact Us</b></h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Get in Touch</h3>
                <p><i class="fa fa-phone"></i> +{{$information->phone}}</p>
                <p><i class="fa fa-envelope"></i> {{$information->email}}</p>
                <p><i class="fa fa-map-marker"></i> {{$information->address}}</p>
                <ul class="social-links">
                    <li><a href="{{$information->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{$information->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{$information->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="{{$information->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <h3>Send us a Message</h3>
                <form action="{{route('contactus.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

