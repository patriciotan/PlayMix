
<html>

    <head>
      
        <script src="/js/libs/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
       
            <div id="content" role="main">
                <div id="cwrap">

                    <div id="nowPlay" class="is-audio">
                    <legend>Jason's Playlist</legend>
                        <h3 id="npAction">Paused:</h3>
                        <div id="npTitle"></div>
                    </div>
                    <div id="audiowrap">
                        <div id="audio0">
                            <audio id="audio1" controls="controls">
                                Your browser does not support the HTML5 Audio Tag.
                            </audio>
                        </div>
                        <noscript>Your browser does not support JavaScript or JavaScript has been disabled. You will need to enable JavaScript for this page.</noscript>
                        <div id="extraControls" class="is-audio">
                            <button id="btnPrev" class="ctrlbtn">|&lt;&lt; Prev Track</button> <button id="btnNext" class="ctrlbtn">Next Track &gt;&gt;|</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/libs/jquery-1.8.0.min.js"><\/script>')</script>
        <script type="text/javascript">
            jQuery(function($) {
                var supportsAudio = !!document.createElement('audio').canPlayType;
                if(supportsAudio) {
                    var index = 0,
                    playing = false;
                    mediaPath = '/PlayMix/uploads/mp3/',
                    extension = '',
                    tracks = [
                        {"track":1,"name":"Merry Chrishmasu","length":"03:36","file":"originalchristmassong"},
                        {"track":2,"name":"Desert Night","length":"02:52","file":"06_Sam_Smith_-_Stay_With_Me"},
                        {"track":3,"name":"blahh","length":"03:16","file":"test1"},
                    ],
                    trackCount = tracks.length,
                    npAction = $('#npAction'),
                    npTitle = $('#npTitle'),
                    audio = $('#audio1').bind('play', function() {
                        playing = true;
                        npAction.text('Now Playing:');
                    }).bind('pause', function() {
                        playing = false;
                        npAction.text('Paused:');
                    }).bind('ended', function() {
                        npAction.text('Paused:');
                        if((index + 1) < trackCount) {
                            index++;
                            loadTrack(index);
                            audio.play();
                        } else {
                            audio.pause();
                            index = 0;
                            loadTrack(index);
                        }
                    }).get(0),
                    btnPrev = $('#btnPrev').click(function() {
                        if((index - 1) > -1) {
                            index--;
                            loadTrack(index);
                            if(playing) {
                                audio.play();
                            }
                        } else {
                            audio.pause();
                            index = 0;
                            loadTrack(index);
                        }
                    }),
                    btnNext = $('#btnNext').click(function() {
                        if((index + 1) < trackCount) {
                            index++;
                            loadTrack(index);
                            if(playing) {
                                audio.play();
                            }
                        } else {
                            audio.pause();
                            index = 0;
                            loadTrack(index);
                        }
                    }),
                    li = $('#plUL li').click(function() {
                        var id = parseInt($(this).index());
                        if(id !== index) {
                            playTrack(id);
                        }
                    }),
                    loadTrack = function(id) {
                        $('.plSel').removeClass('plSel');
                        $('#plUL li:eq(' + id + ')').addClass('plSel');
                        npTitle.text(tracks[id].name);
                        index = id;
                        audio.src = mediaPath + tracks[id].file + extension;
                    },
                    playTrack = function(id) {
                        loadTrack(id);
                        audio.play();
                    };
                    
                    extension = audio.canPlayType('audio/mpeg') ? '.mp3' : audio.canPlayType('audio/ogg') ? '.ogg' : '';

                    loadTrack(index);
                }

                $('#useLegend').click(function(e) {
                    e.preventDefault();
                    $('#use').slideToggle(300, function() {
                        $('#useSpanSpan').text(($('#use').css('display') == 'none' ? 'show' : 'hide'));
                    });
                });
            });
        </script>
    </body>
</html>
