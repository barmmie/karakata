@extends('layouts.public')

@section('content')
    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <h4 class="header">My items</h4>

                        <div class="ui secondary pointing vertical menu">
                            <a class="active teal item">
                                My items
                                <div class="ui teal pointing left label">{{Auth::user()->items()->count()}}</div>
                            </a>
                            <a class="item ">

                                Liked items
                                <div class="ui left label">{{Auth::user()->likedItems()->count()}}</div>
                            </a>


                        </div>




                    </div>

                    <div class="ui segment">
                        <h4 class="header">Enclassified</h4>
                        <div class="ui secondary pointing vertical menu">
                            <a class="teal item">
                                <i class="user icon"></i>
                                Update profile
                            </a>
                            <a class="item">
                                <i class="sign out icon"></i>
                                Logout

                            </a>


                        </div>
                    </div>
                </div>


            </div>

            <div class="twelve wide column">
                <div class="ui segment">
                    <h3 class="ui dividing header">
                        <i class="folder icon"></i>
                        My items
                    </h3>

                    @if(count($items) < 1)
                        <div class="ui message">
                            You currently have no active items for sale.
                        </div>

                    @else
                        <div class="ui divided items">
                            <div class="item">
                                <div class="image">
                                    <img src="/images/wireframe/image.png">
                                </div>
                                <div class="content">
                                    <a class="header">12 Years a Slave</a>
                                    <div class="meta">
                                        <span class="cinema">Union Square 14</span>
                                    </div>
                                    <div class="description">
                                        <p></p>
                                    </div>
                                    <div class="extra">
                                        <div class="ui label">IMAX</div>
                                        <div class="ui label"><i class="globe icon"></i> Additional Languages</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="/images/wireframe/image.png">
                                </div>
                                <div class="content">
                                    <a class="header">My Neighbor Totoro</a>
                                    <div class="meta">
                                        <span class="cinema">IFC Cinema</span>
                                    </div>
                                    <div class="description">
                                        <p></p>
                                    </div>
                                    <div class="extra">
                                        <div class="ui right floated primary button">
                                            Buy tickets
                                            <i class="right chevron icon"></i>
                                        </div>
                                        <div class="ui label">Limited</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="/images/wireframe/image.png">
                                </div>
                                <div class="content">
                                    <a class="header">Watchmen</a>
                                    <div class="meta">
                                        <span class="cinema">IFC</span>
                                    </div>
                                    <div class="description">
                                        <p></p>
                                    </div>
                                    <div class="extra">
                                        <div class="ui right floated primary button">
                                            Buy tickets
                                            <i class="right chevron icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif



                </div>
            </div>
        </div>
    </div>


@endsection