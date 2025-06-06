
function select_actions()
{
    this.toggleAll = function(list, toggle_value)
    {
        if (toggle_value === false)
        {
            list.forEach(function (t)
            {
                t.selected = true;
            });

            return true;
        } else
        {
            list.forEach(function (t)
            {
                t.selected = false;
            });

            return false;
        }
    };

    this.toggle = function(row)
    {
        row.selected = row.selected === false;
    };

    this.getSelection = function (list)
    {
        return list.filter(function isSelected(t)
        {
            return t.selected === true;
        });
    };

    this.togglePage = function(list, data, toggle_value)
    {
        var end = (data.from - 1 + data.per_page);
        var max_limit = (end < list.length) ? end : list.length;

        for (var i = (data.from - 1); i < max_limit; i++)
            (toggle_value === false) ? (list[i].selected = true) : (list[i].selected = false);

        return (toggle_value === false);
    };

    this.downloadFile = function(path, name)
    {
        const link = document.createElement("a");
        link.href = path;
        link.target = '_blank';
        link.download = name;
        link.click();
        link.remove();
    };
}
