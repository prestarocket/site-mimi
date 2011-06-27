/*
 * jQuery Cycle Plugin (with Transition Definitions)
 * Examples and documentation at: http://jquery.malsup.com/cycle/
 * Copyright (c) 2007-2009 M. Alsup
 * Version: 2.37 (12-FEB-2009)
 */
;(function(F){var A="2.37";if(F.support==undefined){F.support={opacity:!(F.browser.msie&&/MSIE 6.0/.test(navigator.userAgent))}}function C(){if(window.console&&window.console.log){window.console.log("[cycle] "+Array.prototype.join.call(arguments,""))}}F.fn.cycle=function(I){if(this.length==0){C("terminating; zero elements found by selector"+(F.isReady?"":" (DOM not ready)"));return this}var J=arguments[1];return this.each(function(){if(this.cycleStop==undefined){this.cycleStop=0}if(I===undefined||I===null){I={}}if(I.constructor==String){switch(I){case"stop":this.cycleStop++;if(this.cycleTimeout){clearTimeout(this.cycleTimeout)}this.cycleTimeout=0;F(this).removeData("cycle.opts");return ;case"pause":this.cyclePause=1;return ;case"resume":this.cyclePause=0;if(J===true){I=F(this).data("cycle.opts");if(!I){C("options not found, can not resume");return }if(this.cycleTimeout){clearTimeout(this.cycleTimeout);this.cycleTimeout=0}D(I.elements,I,1,1)}return ;default:I={fx:I}}}else{if(I.constructor==Number){var S=I;I=F(this).data("cycle.opts");if(!I){C("options not found, can not advance slide");return }if(S<0||S>=I.elements.length){C("invalid slide index: "+S);return }I.nextSlide=S;if(this.cycleTimeout){clearTimeout(this.cycleTimeout);this.cycleTimeout=0}D(I.elements,I,1,S>=I.currSlide);return }}if(this.cycleTimeout){clearTimeout(this.cycleTimeout)}this.cycleTimeout=0;this.cyclePause=0;var X=F(this);var T=I.slideExpr?F(I.slideExpr,this):X.children();var N=T.get();if(N.length<2){C("terminating; too few slides: "+N.length);return }var K=F.extend({},F.fn.cycle.defaults,I||{},F.metadata?X.metadata():F.meta?X.data():{});if(K.autostop){K.countdown=K.autostopCount||N.length}X.data("cycle.opts",K);K.container=this;K.stopCount=this.cycleStop;K.elements=N;K.before=K.before?[K.before]:[];K.after=K.after?[K.after]:[];K.after.unshift(function(){K.busy=0});if(K.continuous){K.after.push(function(){D(N,K,0,!K.rev)})}if(!F.support.opacity&&K.cleartype&&!K.cleartypeNoBg){B(T)}var Z=this.className;K.width=parseInt((Z.match(/w:(\d+)/)||[])[1])||K.width;K.height=parseInt((Z.match(/h:(\d+)/)||[])[1])||K.height;K.timeout=parseInt((Z.match(/t:(\d+)/)||[])[1])||K.timeout;if(X.css("position")=="static"){X.css("position","relative")}if(K.width){X.width(K.width)}if(K.height&&K.height!="auto"){X.height(K.height)}if(K.startingSlide){K.startingSlide=parseInt(K.startingSlide)}if(K.random){K.randomMap=[];for(var P=0;P<N.length;P++){K.randomMap.push(P)}K.randomMap.sort(function(d,c){return Math.random()-0.5});K.randomIndex=0;K.startingSlide=K.randomMap[0]}else{if(K.startingSlide>=N.length){K.startingSlide=0}}var R=K.startingSlide||0;T.css({position:"absolute",top:0,left:0}).hide().each(function(a){var b=R?a>=R?N.length-(a-R):R-a:N.length-a;F(this).css("z-index",b)});F(N[R]).css("opacity",1).show();if(F.browser.msie){N[R].style.removeAttribute("filter")}if(K.fit&&K.width){T.width(K.width)}if(K.fit&&K.height&&K.height!="auto"){T.height(K.height)}var O=K.containerResize&&!X.innerHeight();if(O){var U=0,M=0;for(var P=0;P<N.length;P++){var L=F(N[P]),W=L.outerWidth(),Q=L.outerHeight();U=W>U?W:U;M=Q>M?Q:M}X.css({width:U+"px",height:M+"px"})}if(K.pause){X.hover(function(){this.cyclePause++},function(){this.cyclePause--})}var Y=F.fn.cycle.transitions[K.fx];if(F.isFunction(Y)){Y(X,T,K)}else{if(K.fx!="custom"){C("unknown transition: "+K.fx)}}T.each(function(){var a=F(this);this.cycleH=(K.fit&&K.height)?K.height:a.height();this.cycleW=(K.fit&&K.width)?K.width:a.width()});K.cssBefore=K.cssBefore||{};K.animIn=K.animIn||{};K.animOut=K.animOut||{};T.not(":eq("+R+")").css(K.cssBefore);if(K.cssFirst){F(T[R]).css(K.cssFirst)}if(K.timeout){K.timeout=parseInt(K.timeout);if(K.speed.constructor==String){K.speed=F.fx.speeds[K.speed]||parseInt(K.speed)}if(!K.sync){K.speed=K.speed/2}while((K.timeout-K.speed)<250){K.timeout+=K.speed}}if(K.easing){K.easeIn=K.easeOut=K.easing}if(!K.speedIn){K.speedIn=K.speed}if(!K.speedOut){K.speedOut=K.speed}K.slideCount=N.length;K.currSlide=K.lastSlide=R;if(K.random){K.nextSlide=K.currSlide;if(++K.randomIndex==N.length){K.randomIndex=0}K.nextSlide=K.randomMap[K.randomIndex]}else{K.nextSlide=K.startingSlide>=(N.length-1)?0:K.startingSlide+1}var V=T[R];if(K.before.length){K.before[0].apply(V,[V,V,K,true])}if(K.after.length>1){K.after[1].apply(V,[V,V,K,true])}if(K.click&&!K.next){K.next=K.click}if(K.next){F(K.next).bind("click",function(){return E(N,K,K.rev?-1:1)})}if(K.prev){F(K.prev).bind("click",function(){return E(N,K,K.rev?1:-1)})}if(K.pager){H(N,K)}K.addSlide=function(b,c){var a=F(b),d=a[0];if(!K.autostopCount){K.countdown++}N[c?"unshift":"push"](d);if(K.els){K.els[c?"unshift":"push"](d)}K.slideCount=N.length;a.css("position","absolute");a[c?"prependTo":"appendTo"](X);if(c){K.currSlide++;K.nextSlide++}if(!F.support.opacity&&K.cleartype&&!K.cleartypeNoBg){B(a)}if(K.fit&&K.width){a.width(K.width)}if(K.fit&&K.height&&K.height!="auto"){T.height(K.height)}d.cycleH=(K.fit&&K.height)?K.height:a.height();d.cycleW=(K.fit&&K.width)?K.width:a.width();a.css(K.cssBefore);if(K.pager){F.fn.cycle.createPagerAnchor(N.length-1,d,F(K.pager),N,K)}if(typeof K.onAddSlide=="function"){K.onAddSlide(a)}};if(K.timeout||K.continuous){this.cycleTimeout=setTimeout(function(){D(N,K,0,!K.rev)},K.continuous?10:K.timeout+(K.delay||0))}})};function D(N,I,M,O){if(M&&I.busy){F(N).stop(true,true);I.busy=false}if(I.busy){return }var L=I.container,Q=N[I.currSlide],P=N[I.nextSlide];if(L.cycleStop!=I.stopCount||L.cycleTimeout===0&&!M){return }if(!M&&!L.cyclePause&&((I.autostop&&(--I.countdown<=0))||(I.nowrap&&!I.random&&I.nextSlide<I.currSlide))){if(I.end){I.end(I)}return }if(M||!L.cyclePause){if(I.before.length){F.each(I.before,function(R,S){if(L.cycleStop!=I.stopCount){return }S.apply(P,[Q,P,I,O])})}var J=function(){if(F.browser.msie&&I.cleartype){this.style.removeAttribute("filter")}F.each(I.after,function(R,S){if(L.cycleStop!=I.stopCount){return }S.apply(P,[Q,P,I,O])})};if(I.nextSlide!=I.currSlide){I.busy=1;if(I.fxFn){I.fxFn(Q,P,I,J,O)}else{if(F.isFunction(F.fn.cycle[I.fx])){F.fn.cycle[I.fx](Q,P,I,J)}else{F.fn.cycle.custom(Q,P,I,J,M&&I.fastOnEvent)}}}I.lastSlide=I.currSlide;if(I.random){I.currSlide=I.nextSlide;if(++I.randomIndex==N.length){I.randomIndex=0}I.nextSlide=I.randomMap[I.randomIndex]}else{var K=(I.nextSlide+1)==N.length;I.nextSlide=K?0:I.nextSlide+1;I.currSlide=K?N.length-1:I.nextSlide-1}if(I.pager){F.fn.cycle.updateActivePagerLink(I.pager,I.currSlide)}}if(I.timeout&&!I.continuous){L.cycleTimeout=setTimeout(function(){D(N,I,0,!I.rev)},G(Q,P,I,O))}else{if(I.continuous&&L.cyclePause){L.cycleTimeout=setTimeout(function(){D(N,I,0,!I.rev)},10)}}}F.fn.cycle.updateActivePagerLink=function(I,J){F(I).find("a").removeClass("activeSlide").filter("a:eq("+J+")").addClass("activeSlide")};function G(M,K,L,J){if(L.timeoutFn){var I=L.timeoutFn(M,K,L,J);if(I!==false){return I}}return L.timeout}function E(I,J,M){var L=J.container,K=L.cycleTimeout;if(K){clearTimeout(K);L.cycleTimeout=0}if(J.random&&M<0){J.randomIndex--;if(--J.randomIndex==-2){J.randomIndex=I.length-2}else{if(J.randomIndex==-1){J.randomIndex=I.length-1}}J.nextSlide=J.randomMap[J.randomIndex]}else{if(J.random){if(++J.randomIndex==I.length){J.randomIndex=0}J.nextSlide=J.randomMap[J.randomIndex]}else{J.nextSlide=J.currSlide+M;if(J.nextSlide<0){if(J.nowrap){return false}J.nextSlide=I.length-1}else{if(J.nextSlide>=I.length){if(J.nowrap){return false}J.nextSlide=0}}}}if(J.prevNextClick&&typeof J.prevNextClick=="function"){J.prevNextClick(M>0,J.nextSlide,I[J.nextSlide])}D(I,J,1,M>=0);return false}function H(J,K){var I=F(K.pager);F.each(J,function(L,M){F.fn.cycle.createPagerAnchor(L,M,I,J,K)});F.fn.cycle.updateActivePagerLink(K.pager,K.startingSlide)}F.fn.cycle.createPagerAnchor=function(L,M,J,K,N){var I=(typeof N.pagerAnchorBuilder=="function")?N.pagerAnchorBuilder(L,M):'<a href="#">'+(L+1)+"</a>";if(!I){return }var O=F(I);if(O.parents("body").length==0){O.appendTo(J)}O.bind(N.pagerEvent,function(){N.nextSlide=L;var Q=N.container,P=Q.cycleTimeout;if(P){clearTimeout(P);Q.cycleTimeout=0}if(typeof N.pagerClick=="function"){N.pagerClick(N.nextSlide,K[N.nextSlide])}D(K,N,1,N.currSlide<L);return false});if(N.pauseOnPagerHover){O.hover(function(){N.container.cyclePause++},function(){N.container.cyclePause--})}};F.fn.cycle.hopsFromLast=function(L,K){var J,I=L.lastSlide,M=L.currSlide;if(K){J=M>I?M-I:L.slideCount-I}else{J=M<I?I-M:I+L.slideCount-M}return J};function B(K){function J(L){var L=parseInt(L).toString(16);return L.length<2?"0"+L:L}function I(N){for(;N&&N.nodeName.toLowerCase()!="html";N=N.parentNode){var L=F.css(N,"background-color");if(L.indexOf("rgb")>=0){var M=L.match(/\d+/g);return"#"+J(M[0])+J(M[1])+J(M[2])}if(L&&L!="transparent"){return L}}return"#ffffff"}K.each(function(){F(this).css("background-color",I(this))})}F.fn.cycle.custom=function(T,N,I,K,J){var S=F(T),O=F(N);O.css(I.cssBefore);var L=I.speedIn;var R=I.speedOut;var M=I.easeIn;var Q=I.easeOut;if(J){if(typeof J=="number"){L=R=J}else{L=R=1}M=Q=null}var P=function(){O.animate(I.animIn,L,M,K)};S.animate(I.animOut,R,Q,function(){if(I.cssAfter){S.css(I.cssAfter)}if(!I.sync){P()}});if(I.sync){P()}};F.fn.cycle.transitions={fade:function(J,K,I){K.not(":eq("+I.startingSlide+")").css("opacity",0);I.before.push(function(){F(this).show()});I.animIn={opacity:1};I.animOut={opacity:0};I.cssBefore={opacity:0};I.cssAfter={display:"none"};I.onAddSlide=function(L){L.hide()}}};F.fn.cycle.ver=function(){return A};F.fn.cycle.defaults={fx:"fade",timeout:4000,timeoutFn:null,continuous:0,speed:1000,speedIn:null,speedOut:null,next:null,prev:null,prevNextClick:null,pager:null,pagerClick:null,pagerEvent:"click",pagerAnchorBuilder:null,before:null,after:null,end:null,easing:null,easeIn:null,easeOut:null,shuffle:null,animIn:null,animOut:null,cssBefore:null,cssAfter:null,fxFn:null,height:"auto",startingSlide:0,sync:1,random:0,fit:0,containerResize:1,pause:0,pauseOnPagerHover:0,autostop:0,autostopCount:0,delay:0,slideExpr:null,cleartype:0,nowrap:0,fastOnEvent:0}})(jQuery);(function(A){A.fn.cycle.transitions.scrollUp=function(C,D,B){C.css("overflow","hidden");B.before.push(function(G,E,F){A(this).show();F.cssBefore.top=E.offsetHeight-1;F.animOut.top=0-G.offsetHeight});B.cssFirst={top:0};B.animIn={top:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.scrollDown=function(C,D,B){C.css("overflow","hidden");B.before.push(function(G,E,F){A(this).show();F.cssBefore.top=1-E.offsetHeight;F.animOut.top=G.offsetHeight});B.cssFirst={top:0};B.animIn={top:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.scrollLeft=function(C,D,B){C.css("overflow","hidden");B.before.push(function(G,E,F){A(this).show();F.cssBefore.left=E.offsetWidth-1;F.animOut.left=0-G.offsetWidth});B.cssFirst={left:0};B.animIn={left:0}};A.fn.cycle.transitions.scrollRight=function(C,D,B){C.css("overflow","hidden");B.before.push(function(G,E,F){A(this).show();F.cssBefore.left=1-E.offsetWidth;F.animOut.left=G.offsetWidth});B.cssFirst={left:0};B.animIn={left:0}};A.fn.cycle.transitions.scrollHorz=function(C,D,B){C.css("overflow","hidden").width();B.before.push(function(I,G,H,F){A(this).show();var E=I.offsetWidth,J=G.offsetWidth;H.cssBefore=F?{left:J-1}:{left:1-J};H.animIn.left=0;H.animOut.left=F?-E:E;D.not(I).css(H.cssBefore)});B.cssFirst={left:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.scrollVert=function(C,D,B){C.css("overflow","hidden");B.before.push(function(J,G,H,F){A(this).show();var I=J.offsetHeight,E=G.offsetHeight;H.cssBefore=F?{top:1-E}:{top:E-1};H.animIn.top=0;H.animOut.top=F?I:-I;D.not(J).css(H.cssBefore)});B.cssFirst={top:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.slideX=function(C,D,B){B.before.push(function(G,E,F){A(G).css("zIndex",1)});B.onAddSlide=function(E){E.hide()};B.cssBefore={zIndex:2};B.animIn={width:"show"};B.animOut={width:"hide"}};A.fn.cycle.transitions.slideY=function(C,D,B){B.before.push(function(G,E,F){A(G).css("zIndex",1)});B.onAddSlide=function(E){E.hide()};B.cssBefore={zIndex:2};B.animIn={height:"show"};B.animOut={height:"hide"}};A.fn.cycle.transitions.shuffle=function(E,F,D){var B=E.css("overflow","visible").width();F.css({left:0,top:0});D.before.push(function(){A(this).show()});D.speed=D.speed/2;D.random=0;D.shuffle=D.shuffle||{left:-B,top:15};D.els=[];for(var C=0;C<F.length;C++){D.els.push(F[C])}for(var C=0;C<D.startingSlide;C++){D.els.push(D.els.shift())}D.fxFn=function(L,J,K,G,I){var H=I?A(L):A(J);H.animate(K.shuffle,K.speedIn,K.easeIn,function(){var N=A.fn.cycle.hopsFromLast(K,I);for(var O=0;O<N;O++){I?K.els.push(K.els.shift()):K.els.unshift(K.els.pop())}if(I){for(var P=0,M=K.els.length;P<M;P++){A(K.els[P]).css("z-index",M-P)}}else{var Q=A(L).css("z-index");H.css("z-index",parseInt(Q)+1)}H.animate({left:0,top:0},K.speedOut,K.easeOut,function(){A(I?this:L).hide();if(G){G()}})})};D.onAddSlide=function(G){G.hide()}};A.fn.cycle.transitions.turnUp=function(C,D,B){B.before.push(function(G,E,F){A(this).show();F.cssBefore.top=E.cycleH;F.animIn.height=E.cycleH});B.onAddSlide=function(E){E.hide()};B.cssFirst={top:0};B.cssBefore={height:0};B.animIn={top:0};B.animOut={height:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.turnDown=function(C,D,B){B.before.push(function(G,E,F){A(this).show();F.animIn.height=E.cycleH;F.animOut.top=G.cycleH});B.onAddSlide=function(E){E.hide()};B.cssFirst={top:0};B.cssBefore={top:0,height:0};B.animOut={height:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.turnLeft=function(C,D,B){B.before.push(function(G,E,F){A(this).show();F.cssBefore.left=E.cycleW;F.animIn.width=E.cycleW});B.onAddSlide=function(E){E.hide()};B.cssBefore={width:0};B.animIn={left:0};B.animOut={width:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.turnRight=function(C,D,B){B.before.push(function(G,E,F){A(this).show();F.animIn.width=E.cycleW;F.animOut.left=G.cycleW});B.onAddSlide=function(E){E.hide()};B.cssBefore={left:0,width:0};B.animIn={left:0};B.animOut={width:0};B.cssAfter={display:"none"}};A.fn.cycle.transitions.zoom=function(C,D,B){B.cssFirst={top:0,left:0};B.cssAfter={display:"none"};B.before.push(function(G,E,F){A(this).show();F.cssBefore={width:0,height:0,top:E.cycleH/2,left:E.cycleW/2};F.cssAfter={display:"none"};F.animIn={top:0,left:0,width:E.cycleW,height:E.cycleH};F.animOut={width:0,height:0,top:G.cycleH/2,left:G.cycleW/2};A(G).css("zIndex",2);A(E).css("zIndex",1)});B.onAddSlide=function(E){E.hide()}};A.fn.cycle.transitions.fadeZoom=function(C,D,B){B.before.push(function(G,E,F){F.cssBefore={width:0,height:0,opacity:1,left:E.cycleW/2,top:E.cycleH/2,zIndex:1};F.animIn={top:0,left:0,width:E.cycleW,height:E.cycleH}});B.animOut={opacity:0};B.cssAfter={zIndex:0}};A.fn.cycle.transitions.blindX=function(D,E,C){var B=D.css("overflow","hidden").width();E.show();C.before.push(function(H,F,G){A(H).css("zIndex",1)});C.cssBefore={left:B,zIndex:2};C.cssAfter={zIndex:1};C.animIn={left:0};C.animOut={left:B}};A.fn.cycle.transitions.blindY=function(D,E,C){var B=D.css("overflow","hidden").height();E.show();C.before.push(function(H,F,G){A(H).css("zIndex",1)});C.cssBefore={top:B,zIndex:2};C.cssAfter={zIndex:1};C.animIn={top:0};C.animOut={top:B}};A.fn.cycle.transitions.blindZ=function(E,F,D){var C=E.css("overflow","hidden").height();var B=E.width();F.show();D.before.push(function(I,G,H){A(I).css("zIndex",1)});D.cssBefore={top:C,left:B,zIndex:2};D.cssAfter={zIndex:1};D.animIn={top:0,left:0};D.animOut={top:C,left:B}};A.fn.cycle.transitions.growX=function(C,D,B){B.before.push(function(G,E,F){F.cssBefore={left:this.cycleW/2,width:0,zIndex:2};F.animIn={left:0,width:this.cycleW};F.animOut={left:0};A(G).css("zIndex",1)});B.onAddSlide=function(E){E.hide().css("zIndex",1)}};A.fn.cycle.transitions.growY=function(C,D,B){B.before.push(function(G,E,F){F.cssBefore={top:this.cycleH/2,height:0,zIndex:2};F.animIn={top:0,height:this.cycleH};F.animOut={top:0};A(G).css("zIndex",1)});B.onAddSlide=function(E){E.hide().css("zIndex",1)}};A.fn.cycle.transitions.curtainX=function(C,D,B){B.before.push(function(G,E,F){F.cssBefore={left:E.cycleW/2,width:0,zIndex:1,display:"block"};F.animIn={left:0,width:this.cycleW};F.animOut={left:G.cycleW/2,width:0};A(G).css("zIndex",2)});B.onAddSlide=function(E){E.hide()};B.cssAfter={zIndex:1,display:"none"}};A.fn.cycle.transitions.curtainY=function(C,D,B){B.before.push(function(G,E,F){F.cssBefore={top:E.cycleH/2,height:0,zIndex:1,display:"block"};F.animIn={top:0,height:this.cycleH};F.animOut={top:G.cycleH/2,height:0};A(G).css("zIndex",2)});B.onAddSlide=function(E){E.hide()};B.cssAfter={zIndex:1,display:"none"}};A.fn.cycle.transitions.cover=function(E,F,D){var G=D.direction||"left";var B=E.css("overflow","hidden").width();var C=E.height();D.before.push(function(J,H,I){I.cssBefore=I.cssBefore||{};I.cssBefore.zIndex=2;I.cssBefore.display="block";if(G=="right"){I.cssBefore.left=-B}else{if(G=="up"){I.cssBefore.top=C}else{if(G=="down"){I.cssBefore.top=-C}else{I.cssBefore.left=B}}}A(J).css("zIndex",1)});if(!D.animIn){D.animIn={left:0,top:0}}if(!D.animOut){D.animOut={left:0,top:0}}D.cssAfter=D.cssAfter||{};D.cssAfter.zIndex=2;D.cssAfter.display="none"};A.fn.cycle.transitions.uncover=function(E,F,D){var G=D.direction||"left";var B=E.css("overflow","hidden").width();var C=E.height();D.before.push(function(J,H,I){I.cssBefore.display="block";if(G=="right"){I.animOut.left=B}else{if(G=="up"){I.animOut.top=-C}else{if(G=="down"){I.animOut.top=C}else{I.animOut.left=-B}}}A(J).css("zIndex",2);A(H).css("zIndex",1)});D.onAddSlide=function(H){H.hide()};if(!D.animIn){D.animIn={left:0,top:0}}D.cssBefore=D.cssBefore||{};D.cssBefore.top=0;D.cssBefore.left=0;D.cssAfter=D.cssAfter||{};D.cssAfter.zIndex=1;D.cssAfter.display="none"};A.fn.cycle.transitions.toss=function(E,F,D){var B=E.css("overflow","visible").width();var C=E.height();D.before.push(function(I,G,H){A(I).css("zIndex",2);H.cssBefore.display="block";if(!H.animOut.left&&!H.animOut.top){H.animOut={left:B*2,top:-C/2,opacity:0}}else{H.animOut.opacity=0}});D.onAddSlide=function(G){G.hide()};D.cssBefore={left:0,top:0,zIndex:1,opacity:1};D.animIn={left:0};D.cssAfter={zIndex:2,display:"none"}};A.fn.cycle.transitions.wipe=function(K,H,C){var J=K.css("overflow","hidden").width();var F=K.height();C.cssBefore=C.cssBefore||{};var D;if(C.clip){if(/l2r/.test(C.clip)){D="rect(0px 0px "+F+"px 0px)"}else{if(/r2l/.test(C.clip)){D="rect(0px "+J+"px "+F+"px "+J+"px)"}else{if(/t2b/.test(C.clip)){D="rect(0px "+J+"px 0px 0px)"}else{if(/b2t/.test(C.clip)){D="rect("+F+"px "+J+"px "+F+"px 0px)"}else{if(/zoom/.test(C.clip)){var L=parseInt(F/2);var E=parseInt(J/2);D="rect("+L+"px "+E+"px "+L+"px "+E+"px)"}}}}}}C.cssBefore.clip=C.cssBefore.clip||D||"rect(0px 0px 0px 0px)";var G=C.cssBefore.clip.match(/(\d+)/g);var L=parseInt(G[0]),B=parseInt(G[1]),I=parseInt(G[2]),E=parseInt(G[3]);C.before.push(function(T,O,R){if(T==O){return }var N=A(T).css("zIndex",2);var M=A(O).css({zIndex:3,display:"block"});var Q=1,P=parseInt((R.speedIn/13))-1;function S(){var V=L?L-parseInt(Q*(L/P)):0;var W=E?E-parseInt(Q*(E/P)):0;var X=I<F?I+parseInt(Q*((F-I)/P||1)):F;var U=B<J?B+parseInt(Q*((J-B)/P||1)):J;M.css({clip:"rect("+V+"px "+U+"px "+X+"px "+W+"px)"});(Q++<=P)?setTimeout(S,13):N.css("display","none")}S()});C.cssAfter={};C.animIn={left:0};C.animOut={left:0}}})(jQuery);
