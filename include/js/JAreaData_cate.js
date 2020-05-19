var __AREADATA__ = {
    'prov': {
        '1': '手机',
        '2': '电脑',
        '3': '图书',
        '4': '家居',
        '5': '艺术',
        '6': '宠物',
        '7': '男装',
        '8': '女装',
        '9': '食品',
        '10': '电器'
    },
    'city': {
        '1': [{'id': '25', 'name': 'vivo'},
            {'id': '21', 'name': '一加'},
            {'id': '22', 'name': '小米'},
            {'id': '23', 'name': '华为'},
            {'id': '24', 'name': '魅族'},
            {'id': '26', 'name': 'OPPO'},
            {'id': '27','name': 'Apple'},
            {'id': '28', 'name': '三星'},
            {'id': '29', 'name': '努比亚'},
            {'id': '30', 'name': '诺基亚'}],
        '2': [{'id': '31', 'name': '键盘'},
            {'id': '32', 'name': '笔记本'},
            {'id': '33', 'name': '台式机'},
            {'id': '34', 'name': '服务器'},
            {'id': '35', 'name': '处理器'},
            {'id': '36', 'name': '显卡'},
            {'id': '37', 'name': '鼠标'},
            {'id': '38', 'name': '硬盘'}],
        '3': [{'id': '39', 'name': '小说'},
            {'id': '40', 'name': '文学'},
            {'id': '41', 'name': '传记'},
            {'id': '42', 'name': '科幻'}],
        '4': [{'id': '43', 'name': '床品套件'},
            {'id': '44', 'name': '被子被芯'},
            {'id': '45', 'name': '毛巾浴巾'}],
        '5': [{'id': '46', 'name': '油画'},
            {'id': '47', 'name': '版画'},
            {'id': '48', 'name': '雕塑'}],
        '6': [{'id': '49', 'name': '狗狗'},
            {'id': '50', 'name': '猫猫'},
            {'id': '51', 'name': '水族'},
            {'id': '52', 'name': '异宠'}],
        '7': [{'id': '53', 'name': '牛仔裤'},
            {'id': '54', 'name': '卫衣'},
            {'id': '55', 'name': 'T恤'}],
        '8': [{'id': '56', 'name': 'T恤'},
            {'id': '57', 'name': '衬衫'},
            {'id': '58', 'name': '套装裙'}],
        '9': [{'id': '59', 'name': '进口食品'},
            {'id': '60', 'name': '休闲食品'},
            {'id': '61', 'name': '茗茶'},
            {'id': '62', 'name': '饮料冲调'},
            {'id': '63', 'name': '粮油调味'}],
        '10': [{'id': '64', 'name': '电视'},
            {'id': '65', 'name': '冰箱'},
            {'id': '66', 'name': '洗衣机'},
            {'id': '67', 'name': '空调'}]
    },
    'dist': {
        '31': [{'id': '66671', 'name': '填充'}],
        '32': [{'id': '66672', 'name': '填充'}],
        '33': [{'id': '66673', 'name': '填充'}],
        '34': [{'id': '66674', 'name': '填充'}],
        '35': [{'id': '66675', 'name': '填充'}],
        '36': [{'id': '66676', 'name': '填充'}],
        '37': [{'id': '66677', 'name': '填充'}],
        '38': [{'id': '66678', 'name': '填充'}],
        '39': [{'id': '66679', 'name': '填充'}],
        '40': [{'id': '66670', 'name': '填充'}],
        '41': [{'id': '666711', 'name': '填充'}],
        '42': [{'id': '666712', 'name': '填充'}],
        '43': [{'id': '666713', 'name': '填充'}],
        '44': [{'id': '666714', 'name': '填充'}],
        '45': [{'id': '666715', 'name': '填充'}],
        '46': [{'id': '666716', 'name': '填充'}],
        '47': [{'id': '666717', 'name': '填充'}],
        '48': [{'id': '666718', 'name': '填充'}],
        '49': [{'id': '666719', 'name': '填充'}],
        '50': [{'id': '666720', 'name': '填充'}],
        '51': [{'id': '666721', 'name': '填充'}],
        '52': [{'id': '666722', 'name': '填充'}],
        '53': [{'id': '666723', 'name': '填充'}],
        '54': [{'id': '666724', 'name': '填充'}],
        '55': [{'id': '666725', 'name': '填充'}],
        '56': [{'id': '666726', 'name': '填充'}],
        '57': [{'id': '666727', 'name': '填充'}],
        '58': [{'id': '666728', 'name': '填充'}],
        '59': [{'id': '666729', 'name': '填充'}],
        '60': [{'id': '666730', 'name': '填充'}],
        '61': [{'id': '666731', 'name': '填充'}],
        '62': [{'id': '666732', 'name': '填充'}],
        '63': [{'id': '666733', 'name': '填充'}],
        '64': [{'id': '666734', 'name': '填充'}],
        '65': [{'id': '666735', 'name': '填充'}],
        '66': [{'id': '666736', 'name': '填充'}],
        '67': [{'id': '666737', 'name': '填充'}]
    },
};
/**
 * 地区选择器
 * @version 1.1.0
 * @author <yangjian102621@gmail.com>
 */
(function ($) {

    $.fn.JAreaSelect = function (options) {

        var obj = {};
        var $container = $(this);
        var areaData = __AREADATA__;  //地区数据
        //初始化参数
        var defaults = {
            prov: 0, //省
            city: 0, //市
            dist: 0, //区
            name: {
                prov: 'province',
                city: 'city',
                dist: 'dist'
            },

            selectClassName: 'form-control', //select class名称

        };

        /* 合并参数 */
        options = $.extend(defaults, options);

        //创建元素
        obj.create = function () {

            obj.province = $('<select class="' + options.selectClassName + '" name="' + options.name.prov + '"></select>');
            //加载所有省级
            $.each(areaData.prov, function (id, name) {
                if (id == options.prov) {
                    obj.province.append('<option value="' + id + '" selected>' + name + '</option>');
                } else {
                    obj.province.append('<option value="' + id + '">' + name + '</option>');
                }
            });

            //绑定选中省级事件
            obj.province.on('change', function () {

                //删除元素
                try {
                    obj.city.remove();
                    obj.dist.remove();
                } catch (e) {
                }

                var pid = $(this).val(); //获取省份id

                if (areaData.city[pid] && areaData.city[pid].length > 0) {

                    obj.city = $('<select class="' + options.selectClassName + '" name="' + options.name.city + '"></select>');
                    $.each(areaData.city[pid], function (i, item) {
                        if (item.id == options.city) {
                            obj.city.append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                        } else {
                            obj.city.append('<option value="' + item.id + '">' + item.name + '</option>');
                        }
                    });

                    //切换城市的时候加载地区
                    obj.city.on("change", function () {

                        try {
                            obj.dist.remove();
                        } catch (e) {
                        }
                        //console.log(obj.getAreaString());

                        var cid = $(this).val();
                        if (areaData.dist[cid] && areaData.dist[cid].length > 0) {
                            obj.dist = $('<select class="' + options.selectClassName + '" name="' + options.name.dist + '" id="dist"></select>');
                            $.each(areaData.dist[cid], function (i, item) {
                                if (item.id == options.dist) {
                                    obj.dist.append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                                } else {
                                    obj.dist.append('<option value="' + item.id + '">' + item.name + '</option>');
                                }
                            });
                            $container.append(obj.dist);
                        }
                    });
                    $container.append(obj.city);
                    obj.city.trigger("change"); //自动触发事件
                }

            });
            $container.append(obj.province);
            obj.province.trigger("change"); //自动触发事件
        }

        //获取区域id
        obj.getAreaId = function () {
            return {
                prov: obj.province.val(),
                city: obj.city ? obj.city.val() : 0,
                dist: obj.dist ? obj.dist.val() : 0
            };
        }

        //获取区域字符串
        obj.getAreaString = function () {
            var html = obj.province.find("option:selected").html();
            try {
                html += obj.city.find("option:selected").html();
                html += obj.dist.find("option:selected").html();
            } catch (e) {
            }
            return html;
        }

        obj.create();
        return obj;

    }
})(jQuery);
