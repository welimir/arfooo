function js2php(obj, path, new_path){
    if (typeof(path) == 'undefined') 
        var path = [];
    if (typeof(new_path) != 'undefined') 
        path.push(new_path);
    var post_str = [];
    if (typeof(obj) == 'array' || typeof(obj) == 'object') {
        for (var n in obj) {
            post_str.push(js2php(obj[n], path, n));
        }
    }
    else 
        if (typeof(obj) != 'function') {
            var base = path.shift();
            post_str.push(base + (path.length > 0 ? '[' + path.join('][') + ']' : '') + '=' + encodeURI(obj));
            path.unshift(base);
        }
    path.pop();
    return post_str.join('&');
}
