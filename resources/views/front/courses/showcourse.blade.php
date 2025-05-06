@extends('front.layout')


@section('content')
    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_padding">
        <div class="container">
            <div class="display-5 text-center mb-5">
                <h2>{{$course->title}} Course</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                        <img class="img-fluid" src="{{ asset("storage/$course->image") }}" alt="">
                    </div>
                    <div class="content_wrapper">
                        <h4 class="title_top">Course Details</h4>
                        <div class="content">
                           {{ $course->desc }}
                        </div>


                        <h4 class="title">Course Outline</h4>
                        <div class="content">
                            <ul class="course_list">
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Introduction Lesson</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Basics of HTML</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Getting Know about HTML</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Tags and Attributes</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Basics of CSS</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Getting Familiar with CSS</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Introduction to Bootstrap</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Responsive Design</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>Canvas in HTML 5</p>
                                    <a class="btn_2 text-uppercase" href="#">View Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">
                        <ul>
                            <li>
                                <h4 class="title_top mt-0">Course Name</h4>
                                    <span class="display-5">{{$course->title}}</span>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Trainer’s Name</p>
                                    <span class="color">{{$course->trainer->user->name}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Course Fee </p>
                                    <span class="text-success fw-bold">{{ $course->price }} EGP</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Students Enrolled</p>
                                    <span>-</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Course Duration : {{$course->duration}} Days</p>
                                </a>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Course Started </p>
                                    <span>{{ $course->start_date }}</span>
                                </a>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Course Ended </p>
                                    <span>{{ $course->end_date }}</span>
                                </a>
                            </li>

                        </ul>
                        <a href="#" class="btn_1 d-block">Enroll the course</a>
                    </div>

                    {{-- <h4 class="title">Reviews</h4>
                    <div class="content">
                        <div class="review-top row pt-40">
                            <div class="col-lg-12">
                                <h6 class="mb-15">Provide Your Rating</h6>
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span>Quality</span>
                                    <div class="rating">
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/star.svg') }}"
                                                alt=""></a>
                                    </div>
                                    <span>Outstanding</span>
                                </div>
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span>Puncuality</span>
                                    <div class="rating">
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/star.svg') }}"
                                                alt=""></a>
                                    </div>
                                    <span>Outstanding</span>
                                </div>
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span>Quality</span>
                                    <div class="rating">
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                alt=""></a>
                                        <a href="#"><img src="{{ asset('front/img/icon/star.svg') }}"
                                                alt=""></a>
                                    </div>
                                    <span>Outstanding</span>
                                </div>

                            </div>
                        </div> --}}
                    <div class="feedeback">
                        {{-- <h6>Your Feedback</h6>
                            <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                            <div class="mt-10 text-right">
                                <a href="#" class="btn_1">Read more</a>
                            </div>
                        </div> --}}
                        <div class="comments-area mb-30">
                            <div class="comment-list">
                                <div class="single-comment single-reviews justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="{{ asset('front/img/cource/cource_1.png') }}" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5><a href="#">{{ $course->trainer->user->name }}</a>
                                            </h5>
                                            <div class="rating">
                                                <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                        alt=""></a>
                                                <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                        alt=""></a>
                                                <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                        alt=""></a>
                                                <a href="#"><img src="{{ asset('front/img/icon/color_star.svg') }}"
                                                        alt=""></a>
                                                <a href="#"><img src="{{ asset('front/img/icon/star.svg') }}"
                                                        alt=""></a>
                                            </div>
                                            <p class="comment">
                                                Spectialist : {{$course->trainer->spec}}
                                            </p>
                                            <p class="comment">
                                                About : {{$course->trainer->desc}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Details Area =================-->
@endsection
