$.fn.isInViewport=function(){var a=$(this).offset().top,b=a+$(this).outerHeight(),c=$(window).scrollTop(),d=c+$(window).height();return b>c&&a<d},$('.item').hover(function(){$('#content').addClass('active'),$(this).prev('.item').addClass('nearby'),$(this).next('.item').addClass('nearby')},function(){$('#content').removeClass('active'),$(this).prev('.item').removeClass('nearby'),$(this).next('.item').removeClass('nearby')}),$('.item[data-url]').click(function(){window.location.href=`video/${$(this).data('url')}`}),$(window).on('wheel',function(a){var b=a.originalEvent.deltaY,c=$(window).scrollTop();0<b&&$(window).scrollTop()+$(window).outerHeight()<parseInt($(window).height())?$('#content').css('backgroundPositionX','+='+parseInt(-c/5)):0>b&&0<$(window).scrollTop()&&$('#content').css('backgroundPositionX','+='+parseInt(c/5))});