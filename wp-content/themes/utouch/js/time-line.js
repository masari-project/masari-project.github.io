// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function ($, window, document, undefined) {

    "use strict";

    // undefined is used here as the undefined global variable in ECMAScript 3 is
    // mutable (ie. it can be changed by someone else). undefined isn't really being
    // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
    // can no longer be modified.

    // window and document are passed through as local variables rather than global
    // as this (slightly) quickens the resolution process and can be more efficiently
    // minified (especially when both are regularly referenced in your plugin).

    // Create the defaults once
    var pluginName = "horizontalTimeline",
        defaults = {
            eventsMinDistance: 90
        };

    // The actual plugin constructor
    function Plugin(element, options) {
        this.element = element;

        // jQuery has an extend method which merges the contents of two or
        // more objects, storing the result in the first object. The first object
        // is generally empty as we don't want to alter the default options for
        // future instances of the plugin
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {
        init: function () {
            var self = this,
                timeline = $(this.element),
                timelineComponents = {};
            //cache timeline components
            self.timelineWrapper = timeline.find('.events-wrapper');
            self.eventsWrapper = self.timelineWrapper.children('.events');
            self.fillingLine = self.eventsWrapper.children('.filling-line');
            self.timelineEvents = self.eventsWrapper.find('a');
            self.timelineDates = self.parseDate(self.timelineEvents);
            self.eventsMinLapse = self.minLapse(self.timelineDates);
            self.timelineNavigation = timeline.find('.cd-timeline-navigation');
            self.eventsContent = timeline.children('.events-content');

            timeline.addClass('cd-horizontal-timeline').addClass('loaded');

            //assign a left postion to the single events along the timeline
            self.setDatePosition(timelineComponents, self.settings.eventsMinDistance);
            //assign a width to the timeline
            var timelineTotWidth = self.setTimelineWidth(timelineComponents, self.settings.eventsMinDistance);
            //the timeline has been initialize - show it

            //detect click on the next arrow
            self.timelineNavigation.on('click', '.next', function (event) {
                event.preventDefault();
                self.updateSlide(timelineComponents, timelineTotWidth, 'next');
            });
            //detect click on the prev arrow
            self.timelineNavigation.on('click', '.prev', function (event) {
                event.preventDefault();
                self.updateSlide(timelineComponents, timelineTotWidth, 'prev');
            });
            //detect click on the a single event - show new event content
            self.eventsWrapper.on('click', 'a', function (event) {
                event.preventDefault();
                self.timelineEvents.removeClass('selected');
                $(this).addClass('selected');
                self.updateOlderEvents($(this));
                self.updateFilling($(this), self.fillingLine, timelineTotWidth);
                self.updateVisibleContent($(this), self.eventsContent);
            });

            //on swipe, show next/prev event content
            self.eventsContent.on('swipeleft', function () {
                var mq = self.checkMQ();
                ( mq == 'mobile' ) && self.showNewContent(timelineComponents, timelineTotWidth, 'next');
            });
            self.eventsContent.on('swiperight', function () {
                var mq = self.checkMQ();
                ( mq == 'mobile' ) && self.showNewContent(timelineComponents, timelineTotWidth, 'prev');
            });

            //keyboard navigation
            $(document).keyup(function (event) {
                if (event.which == '37' && self.elementInViewport(timeline.get(0))) {
                    self.showNewContent(timelineComponents, timelineTotWidth, 'prev');
                } else if (event.which == '39' && self.elementInViewport(timeline.get(0))) {
                    self.showNewContent(timelineComponents, timelineTotWidth, 'next');
                }
            });
        },

        updateSlide: function (timelineComponents, timelineTotWidth, string) {
            //retrieve translateX value of self.eventsWrapper
            var self = this,
                translateValue = self.getTranslateValue(self.eventsWrapper),
                wrapperWidth = Number(self.timelineWrapper.css('width').replace('px', ''));
            //translate the timeline to the left('next')/right('prev')
            (string == 'next')
                ? self.translateTimeline(timelineComponents, translateValue - wrapperWidth + self.settings.eventsMinDistance, wrapperWidth - timelineTotWidth)
                : self.translateTimeline(timelineComponents, translateValue + wrapperWidth - self.settings.eventsMinDistance);
        },

        showNewContent: function (timelineComponents, timelineTotWidth, string) {
            //go from one event to the next/previous one
            var self = this,
                visibleContent = self.eventsContent.find('.selected'),
                newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

            if (newContent.length > 0) { //if there's a next/prev event - show it
                var selectedDate = self.eventsWrapper.find('.selected'),
                    newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');

                self.updateFilling(newEvent, self.fillingLine, timelineTotWidth);
                self.updateVisibleContent(newEvent, self.eventsContent);
                newEvent.addClass('selected');
                selectedDate.removeClass('selected');
                self.updateOlderEvents(newEvent);
                self.updateTimelinePosition(string, newEvent, timelineComponents);
            }
        },

        updateTimelinePosition: function (string, event, timelineComponents) {
            //translate timeline to the left/right according to the position of the selected event
            var self = this,
                eventStyle = window.getComputedStyle(event.get(0), null),
                eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
                timelineWidth = Number(self.timelineWrapper.css('width').replace('px', '')),
                timelineTotWidth = Number(self.eventsWrapper.css('width').replace('px', ''));
            var timelineTranslate = self.getTranslateValue(self.eventsWrapper);

            if ((string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < -timelineTranslate)) {
                self.translateTimeline(timelineComponents, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
            }
        },

        translateTimeline: function (timelineComponents, value, totWidth) {
            var self = this,
                eventsWrapper = self.eventsWrapper.get(0);
            value = (value > 0) ? 0 : value; //only negative translate value
            value = ( !(typeof totWidth === 'undefined') && value < totWidth ) ? totWidth : value; //do not translate more than timeline width
            self.setTransformValue(eventsWrapper, 'translateX', value + 'px');
            //update navigation arrows visibility
            (value == 0 ) ? self.timelineNavigation.find('.prev').addClass('inactive') : self.timelineNavigation.find('.prev').removeClass('inactive');
            (value == totWidth ) ? self.timelineNavigation.find('.next').addClass('inactive') : self.timelineNavigation.find('.next').removeClass('inactive');
        },

        updateFilling: function (selectedEvent, filling, totWidth) {
            //change .filling-line length according to the selected event
            var self = this,
                eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
                eventLeft = eventStyle.getPropertyValue("left"),
                eventWidth = eventStyle.getPropertyValue("width");
            eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;
            var scaleValue = eventLeft / totWidth;
            self.setTransformValue(filling.get(0), 'scaleX', scaleValue);
        },

        setDatePosition: function (timelineComponents, min) {
            var self = this;
            for (var i = 0; i < self.timelineDates.length; i++) {
                var distance = self.daydiff(self.timelineDates[0], self.timelineDates[i]),
                    distanceNorm = Math.round(distance / self.eventsMinLapse) + 2;
                self.timelineEvents.eq(i).css('left', distanceNorm * min + 'px');
            }
        },

        setTimelineWidth: function (timelineComponents, width) {
            var self = this,
                timeSpan = self.daydiff(self.timelineDates[0], self.timelineDates[self.timelineDates.length - 1]),
                timeSpanNorm = timeSpan / self.eventsMinLapse,
                timeSpanNorm = Math.round(timeSpanNorm) + 4,
                totalWidth = timeSpanNorm * width;
            self.eventsWrapper.css('width', totalWidth + 'px');
            self.updateFilling(self.eventsWrapper.find('a.selected'), self.fillingLine, totalWidth);
            self.updateTimelinePosition('next', self.eventsWrapper.find('a.selected'), timelineComponents);

            return totalWidth;
        },

        updateVisibleContent: function (event, eventsContent) {
            var self = this,
                eventDate = event.data('date'),
                visibleContent = eventsContent.find('.selected'),
                selectedContent = eventsContent.find('[data-date="' + eventDate + '"]'),
                selectedContentHeight = selectedContent.height();

            if (selectedContent.index() > visibleContent.index()) {
                var classEnetering = 'selected enter-right',
                    classLeaving = 'leave-left';
            } else {
                var classEnetering = 'selected enter-left',
                    classLeaving = 'leave-right';
            }

            selectedContent.attr('class', classEnetering);
            visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                visibleContent.removeClass('leave-right leave-left');
                selectedContent.removeClass('enter-left enter-right');
            });
            eventsContent.css('height', selectedContentHeight + 'px');
        },

        updateOlderEvents: function (event) {
            var self = this;
            event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
        },

        getTranslateValue: function (timeline) {
            var self = this,
                timelineStyle = window.getComputedStyle(timeline.get(0), null),
                timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
                    timelineStyle.getPropertyValue("-moz-transform") ||
                    timelineStyle.getPropertyValue("-ms-transform") ||
                    timelineStyle.getPropertyValue("-o-transform") ||
                    timelineStyle.getPropertyValue("transform");

            if (timelineTranslate.indexOf('(') >= 0) {
                var timelineTranslate = timelineTranslate.split('(')[1];
                timelineTranslate = timelineTranslate.split(')')[0];
                timelineTranslate = timelineTranslate.split(',');
                var translateValue = timelineTranslate[4];
            } else {
                var translateValue = 0;
            }

            return Number(translateValue);
        },

        setTransformValue: function (element, property, value) {
            var self = this;
            element.style["-webkit-transform"] = property + "(" + value + ")";
            element.style["-moz-transform"] = property + "(" + value + ")";
            element.style["-ms-transform"] = property + "(" + value + ")";
            element.style["-o-transform"] = property + "(" + value + ")";
            element.style["transform"] = property + "(" + value + ")";
        },

        //based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
        parseDate: function (events) {
            var self = this,
                dateArrays = [];
            events.each(function () {
                var singleDate = $(this),
                    dateComp = singleDate.data('date').split('T');
                if (dateComp.length > 1) { //both DD/MM/YEAR and time are provided
                    var dayComp = dateComp[0].split('/'),
                        timeComp = dateComp[1].split(':');
                } else if (dateComp[0].indexOf(':') >= 0) { //only time is provide
                    var dayComp = ["2000", "0", "0"],
                        timeComp = dateComp[0].split(':');
                } else { //only DD/MM/YEAR
                    var dayComp = dateComp[0].split('/'),
                        timeComp = ["0", "0"];
                }
                var newDate = new Date(dayComp[2], dayComp[1] - 1, dayComp[0], timeComp[0], timeComp[1]);
                dateArrays.push(newDate);
            });
            return dateArrays;
        },

        daydiff: function (first, second) {
            var self = this;
            return Math.round((second - first));
        },

        minLapse: function (dates) {
            //determine the minimum distance among events
            var self = this,
                dateDistances = [];
            for (var i = 1; i < dates.length; i++) {
                var distance = self.daydiff(dates[i - 1], dates[i]);
                dateDistances.push(distance);
            }
            return Math.min.apply(null, dateDistances);
        },

        /*
         How to tell if a DOM element is visible in the current viewport?
         http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
         */
        elementInViewport: function (el) {
            var self = this;
            var top = el.offsetTop;
            var left = el.offsetLeft;
            var width = el.offsetWidth;
            var height = el.offsetHeight;

            while (el.offsetParent) {
                el = el.offsetParent;
                top += el.offsetTop;
                left += el.offsetLeft;
            }

            return (
                top < (window.pageYOffset + window.innerHeight) &&
                left < (window.pageXOffset + window.innerWidth) &&
                (top + height) > window.pageYOffset &&
                (left + width) > window.pageXOffset
            );
        },

        checkMQ: function () {
            //check if mobile or desktop device
            var self = this;
            return window.getComputedStyle(document.querySelector(self.element), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
        }
    });

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" +
                    pluginName, new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);