
app.filter('bytesToSize', function()
{
    return function(bytes) {
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes === 0) return 'n/a';
        const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10);
        if (i === 0) return `${bytes} ${sizes[i]}`;
        return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`;
    };
});

app.filter('filename', function()
{
    return function(fileName, size) {
        var index = fileName.lastIndexOf('.');
        var fName = fileName.substring(0, index);
        var fExtension = fileName.substring(index);

        if (fName.length > size && size > 14)
            return fName.substr(0,size-5) + "..." + fName.substr(-5) + fExtension;
        else
            return fileName;
    };
});

app.filter('productname', function()
{
    return function(pName, size) {
        if (pName.length > size)
            return pName.substr(0,size) + "...";
        else
            return pName;
    };
});

