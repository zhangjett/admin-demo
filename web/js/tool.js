/**
 * ajax请求工具
 * @requires /layer/* jquery.js
 * @since 2015-11-18
 */
var tool = {
	ajax : function(option) {
		if(typeof(option)!= 'object') return;
		if(option.url==null||option.url==""||typeof(option.url)=="undefined") return;

		var  _option = {},layerId;
		for(var i in option) {
			if (option.hasOwnProperty(i)) {
                _option[i] = option[i];
			}
        }

		if(typeof(_option.timeout)=="undefined") _option.timeout = 20000; // 默认超时设置20秒
		if(typeof(_option.type)=="undefined") _option.type = 'GET';// 默认请求方式GET
		if(typeof(_option.dataType)=="undefined") _option.dataType = 'json';// 默认返回格式JSON
		if(typeof(_option.shade)=="undefined") _option.shade = false; // 是否显示遮罩层
		if(typeof(_option.shadeText)=="undefined") _option.shadeText = "加载中...请稍后"; // 遮罩层文本内容
		if(typeof(_option.async)=="undefined")_option.async=true;//是否是异步的
		if(typeof(_option.data)=="undefined")_option.data="";//请求数据
		if(typeof(_option.opacity)=="undefined")_option.opacity=0.3;//透明度

		_option.beforeSend = function() {
			if(_option.shade){
				layerId = layer.msg(_option.shadeText, {
					icon: 16,
					time: 0, //不自动关闭
					shade:_option.opacity
				});
			}
			if(option.beforeSend && typeof(option.beforeSend) == 'function') option.beforeSend(); // 用户自定义beforeSend
		};

		_option.error = function(response) {
			layerId && layer.close(layerId);
			if(option.error && typeof(option.error)=='function') {
				option.error(response.responseText); // 用户自定义error
			} else {
				layer.msg(response.responseText, {icon: 5,shade:[0.3,'#000']});
			}
		};
		_option.complete = function(XHR, status) {
			if(status == 'timeout') {
				layerId && layer.close(layerId);
				layer.msg("请求超时了哩~", {icon: 5,shade:[0.3,'#000']});
			}
		};
		_option.success = function(response) {
			layerId && layer.close(layerId);
			if(option.success && typeof(option.success)=='function') {
				if(_option.dataType == 'json') { // 指明返回数据格式为json
					if(response && typeof(response) == 'object') {
                        if (response == null||response == ""||(typeof(response)=="undefined")){
                            layer.msg('没有数据返回。。。', {icon: 5,shade:[0.3,'#000']});
							return true;
                        }
                        option.success(response);
					} else {
						layer.msg("额...出错了！", {icon: 5,shade:[0.3,'#000']});
					}
				} else {
					option.success(response); // 用户自定义success
				}
			}
		};
		$.ajax(_option);
	}
};