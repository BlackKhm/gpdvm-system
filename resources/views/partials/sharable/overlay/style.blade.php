<style>
    .button-close-overlay {
        z-index: 1099;
        right: 0;
    }

    .sidenav {
        @if(isset($style))
            @foreach($style as $k => $v)
                {{ $k . ':' . $v . ';' }}
            @endforeach
        @endif
        height: 100%;
        width: 30%;
        position: fixed;
        z-index: 1021;
        top: 0;
        background-color: #fff;
        overflow-x: hidden;
        transition: 0.5s;
    }

    .right {
        right: -30%;
    }

    .left {
        left: -30%;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        left: 0;
        padding: 15px 8px 8px 25px;
    }

    #back_to_top {
        position: fixed;
        bottom: 15px;
        right: 15px;
        z-index: 9999;
    }

    @media only screen and (max-width: 1149px) and (min-width: 581px) {
        .sidenav {
            width: 50%;
        }

        .right {
            right: -50%;
        }

        .left {
            left: -50%;
        }
    }

    @media only screen and (max-width: 581px) {
        .sidenav {
            width: 100%;
        }

        .right {
            right: -100%;
        }

        .left {
            left: -100%;
        }
    }
</style>
