(function() {
    var areaClicks, currentPrize, fieldFilling, getInfo, getModal, getTurn, randomInteger, resetGame, sessionHash, takePrize, updateInfo;

    sessionHash = '';

    getInfo = function() {
        return $.ajax({
            url: '/minigames/hunt/default/info',
            type: 'post',
            dataType: 'json',
            data: {
                _csrf: _csrf
            }
        });
    };

    getTurn = function() {
        return $.ajax({
            url: '/minigames/hunt/default/turn',
            type: 'post',
            dataType: 'json',
            data: {
                sessionHash: sessionHash,
                _csrf: _csrf
            }
        });
    };

    takePrize = function() {
        return $.ajax({
            url: '/minigames/hunt/default/send-prize',
            type: 'post',
            dataType: 'json',
            data: {
                sessionHash: sessionHash,
                _csrf: _csrf
            }
        });
    };

    updateInfo = function(data) {
        var _user, currWinItem, prizelist, userprizes;
        userprizes = '';
        prizelist = '';
        _user = data.user;
        $('.js-hunt_trycount').html(_user.credit);
        $('.js-hunt_wingames').html(_user.progress);
        $('.js-hunt_prizes').html('');
        $.each(data.settings.prizes, function(index, val) {
            if (val.type === 'free_credit') {
                if (JSON.parse(index) === _user.progress) {
                    return prizelist += '<div class="hunt__item" data-pos="' + index + '" data-text="' + val.title + '"><span class="count">x' + val.count + '</span><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '_act.png"></div>';
                } else {
                    return prizelist += '<div class="hunt__item" data-pos="' + index + '" data-text="' + val.title + '"><span class="count">x' + val.count + '</span><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"></div>';
                }
            } else {
                if (JSON.parse(index) === _user.progress) {
                    return prizelist += '<div class="hunt__item" data-pos="' + index + '" data-text="' + val.title + '"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '_act.png"></div>';
                } else {
                    return prizelist += '<div class="hunt__item" data-pos="' + index + '" data-text="' + val.title + '"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"></div>';
                }
            }
        });
        $('.js-hunt_prizes').append(prizelist);
        $.each(_user.history, function(index, val) {
            switch (val.type) {
                case 'souvenir':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Набор сувениров</span></div>';
                case 'cbt_access':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Доступ на закрытый бета-тест: ' + val.pin + '</span></div>';
                case 'set_early_access':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Набор владыки небес</span></div>';
                case 'super_prize':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Суперприз</span></div>';
            }
        });
        $('.js-hunt_userlist').html(userprizes);
        if (_user.progress > 0) {
            currWinItem = $('.js-hunt_prizes div').eq(_user.progress - 1).html();
            $('.js-hunt_takeprize').removeClass('disabled');
            return $('.js-hunt_takeprize span').html(currWinItem);
        }
    };

    areaClicks = function() {
        var contenthtml, i;
        contenthtml = '';
        i = 1;
        while (i < 21) {
            contenthtml += '<div class="hunt_clickBlock js-hunt_currClick" data-click="' + i + '"></div>';
            i++;
        }
        return $('.js-hunt_click').append(contenthtml);
    };

    currentPrize = function(data, currItem) {
        currItem = currItem;
        switch (data.user.lastResult.type) {
            case 'empty':
                return currItem.html('<div class="hunt__currPrize neutral"></div>');
            case 'fail':
                currItem.html('<div class="hunt__currPrize bad"></div>');
                fieldFilling(data, true);
                return getModal('fail', data);
            case 'prize':
                currItem.html('<div class="hunt__currPrize good"></div>');
                if (data.user.progress === 7) {
                    getModal('prize', data);
                    return false;
                }
                break;
            case 'super_prize':
                currItem.html('<div class="hunt__currPrize suppa"></div>');
                return getModal('prize', data);
        }
    };

    $(document).on('click', '.js-hunt_takeprize', function() {
        if (!$(this).hasClass('disabled')) {
            $(this).addClass('disabled');
            return takePrize().done(function(data) {
                if (data.error) {
                    getModal('error', data);
                    return false;
                }
                return getModal('prize', data);
            }).error(function(data) {
                return getModal('error', data);
            });
        }
    });

    $(document).on({
        mouseenter: function() {
            var dataPos, dataText;
            dataText = $(this).data('text');
            dataPos = $(this).data('pos');
            return $('.js-hunt_tooltip').addClass('pos_' + dataPos).html(dataText).stop().fadeIn();
        },
        mouseleave: function() {
            return $('.js-hunt_tooltip').attr('class', 'hunt__tooltip js-hunt_tooltip').html('').hide();
        }
    }, '.js-hunt_prizes div');

    $(document).on('click touchstart', '.js-hunt_currClick', function() {
        var _this;
        _this = $(this);
        if (!_this.hasClass('disabled') && !_this.hasClass('clicked')) {
            _this.addClass('disabled');
            $('.js-hunt_currClick').addClass('clicked');
            return getTurn().done(function(data) {
                if (data.error) {
                    getModal('error', data);
                    return false;
                }
                sessionHash = data.user.sessionHash;
                setTimeout(currentPrize(data, _this), 200);
                updateInfo(data);
                return $('.js-hunt_currClick').removeClass('clicked');
            }).error(function(data) {
                return getModal('error', data);
            });
        }
    });

    getModal = function(type, data) {
        var currentProgress, modalContent;
        if (data.user) {
            currentProgress = data.user.progress;
        }
        modalContent = '';
        $('.js-modal').html('');
        switch (type) {
            case 'prize':
                modalContent += '<h4>Поздравляем!</h4>';
                modalContent += '<div class="hunt__modal_prize"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + data.settings.prizes[currentProgress].type + '_act.png"></div>';
                modalContent += '<p>Вы получили: ' + data.settings.prizes[currentProgress].title + '</p>';
                modalContent += '<div class="hunt__modal_button js-modal_reload">Новая игра</div>';
                break;
            case 'fail':
                modalContent += '<h4>Игра завершена</h4>';
                modalContent += '<p>К сожалению, вы проиграли. Попробуйте еще раз!</p>';
                modalContent += '<div class="hunt__modal_button js-modal_reload">Новая игра</div>';
                break;
            case 'error':
                if (data) {
                    data = JSON.parse(data.responseText);
                }
                modalContent += '<p>' + data.message + '</p>';
                if (data.reload_page) {
                    modalContent += '<a href="" class="hunt__modal_button js-modal_reload">перезагрузить</a>';
                } else {
                    modalContent += '<a href="" class="hunt__modal_button js-modal_close">Закрыть</a>';
                }
        }
        $('.js-modal_overlay').fadeIn();
        return $('.js-modal').html(modalContent).fadeIn();
    };

    $(document).on('click', '.js-modal_close', function() {
        $('.js-modal, .js-modal_overlay').html('').hide();
        return false;
    });

    $(document).on('click', '.js-modal_reload', function() {
        return window.location.reload();
    });

    fieldFilling = function(data, type) {
        var _item, all, bad, fail, good, random_bad, random_fail, random_good;
        _item = $('.js-hunt_currClick');
        all = data.user["try"];
        good = data.user.progress;
        bad = all - good;
        if (type) {
            good = 7 - $('.js-hunt_currClick.disabled .good').length;
            bad = 10 - $('.js-hunt_currClick.disabled .neutral').length;
            if (bad > 10) {
                bad = 10;
            }
            fail = 2;
            while (fail) {
                random_fail = randomInteger(1, 20);
                if (!_item.eq(random_fail - 1).hasClass('disabled')) {
                    _item.eq(random_fail - 1).addClass('disabled').append('<div class="hunt__currPrize bad"></div>');
                    fail--;
                }
            }
        }
        while (good) {
            random_good = randomInteger(1, 20);
            if (!_item.eq(random_good - 1).hasClass('disabled')) {
                _item.eq(random_good - 1).addClass('disabled').append('<div class="hunt__currPrize good"></div>');
                good--;
            }
        }
        while (bad) {
            random_bad = randomInteger(1, 20);
            if (!_item.eq(random_bad - 1).hasClass('disabled')) {
                _item.eq(random_bad - 1).addClass('disabled').append('<div class="hunt__currPrize neutral"></div>');
                bad--;
            }
        }
        return true;
    };

    randomInteger = function(min, max) {
        var rand;
        rand = min - 0.5 + Math.random() * (max - min + 1);
        return rand = Math.round(rand);
    };

    resetGame = function(data) {
        var prizelist, userprizes;
        prizelist = '';
        userprizes = '';
        $('.js-hunt_wingames').html('0');
        $('.js-hunt_trycount').html(data.user.credit);
        $('.js-hunt_currClick, .js-hunt_prizes, .js-hunt_takeprize span, .js-hunt_userlist').html = '';
        $('.js-hunt_takeprize').addClass('disabled');
        $.each(data.settings.prizes, function(index, val) {
            if (val.type === 'free_credit') {
                return prizelist += '<div class="hunt__item" data-pos="' + index + '" data-text="' + val.title + '"><span class="count">x' + val.count + '</span><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"></div>';
            } else {
                return prizelist += '<div class="hunt__item" data-pos="' + index + '" data-text="' + val.title + '"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"></div>';
            }
        });
        $('.js-hunt_prizes').append(prizelist);
        $.each(data.user.history, function(index, val) {
            switch (val.type) {
                case 'souvenir':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Сувенирный набор</span></div>';
                case 'cbt_access':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Доступ на закрытый бета-тест: ' + val.pin + '</span></div>';
                case 'set_early_access':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Набор владыки небес</span></div>';
                case 'super_prize':
                    return userprizes += '<div class="hunt__userItem"><img src="//rev.cdn.gmru.net/minigames/hunt/static/rev/images/prizes/' + val.type + '.png"> <span>Суперприз</span></div>';
            }
        });
        return $('.js-hunt_userlist').html(userprizes);
    };

    getInfo().done(function(data) {
        if (data.error) {
            getModal('error', data);
            return false;
        }
        areaClicks();
        sessionHash = data.user.sessionHash;
        if (data.user.state === 3 || data.user.state === 2) {
            resetGame(data);
            return false;
        }
        updateInfo(data);
        return setTimeout(fieldFilling(data, false), 200);
    }).error(function(data) {
        return getModal('error', data);
    });

}).call(this);
