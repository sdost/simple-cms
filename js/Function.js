// ------------------------------------------------------------------------
// Function - TnB extensions to Javascript OOP
// ------------------------------------------------------------------------


Function.prototype.Extends = function(baseClass)
{
    var prop;

    if (this == baseClass)
    {
        alert("Error - cannot extend self");
        return;
    }

    // Copy method vptrs from super class.
    for (prop in baseClass.prototype)
    {
        if (typeof(baseClass.prototype[prop]) == "function" &&
	    !this.prototype[prop])
	{
            this.prototype[prop] = baseClass.prototype[prop];
	}
    }

    var baseName = baseClass.getName();
    this.prototype.baseName = baseName;
    this.prototype[baseName] = baseClass;
}

Function.prototype.getName = function()
{
    var st;

    st = _fToString(this);
    st = st.substring(st.indexOf(" ") + 1, st.indexOf("("))

    return st;
}

function _fToString(o)
{
    if (o == null)
	return 'null';

    return o.toString().replace(/^\s+/, '').replace(/\s+/g, ' ');
}

function isArray(obj)
{
    return (obj.constructor &&
	    _fToString(obj.constructor).indexOf("Array") != -1);
}

function toggleVisible(obj) {
	if(obj.style.display == '') {
		obj.style.display = 'none';
	} else {
		obj.style.display = '';
	}
}
