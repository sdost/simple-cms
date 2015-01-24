// ========================================================================
// String utilities
// ========================================================================

// Wrap a string in single quotes, escaping as needed.
function sq(x) { return qq(x, "'"); }

// Wrap a double in single quotes, escaping as needed.
function dq(x) { return qq(x, '"'); }

// Quote (single or double), escaping any occurrence of the quote within the
// string.
function qq(x, q)
{
    var escapedQuote = "\\" + q;
    x = "" + x; // stringify, just in case

    var re = new RegExp(q, "g");
    var y = x.replace(re, escapedQuote);

    return q + y + q;
}

// Surround a string with parens.
// The paren type defaults to ().
// If the type is '(', '[', '{', or '<', the ending character is
// matched in the obvious way.
function parens(x, type)
{
    var l = type || '(';
    var r = { '(': ')', '[': ']', '{': '}', '<': '>' }[l];

    return l + x + (r || l);
}

// Attribute string, for use in constructing HTML or XML tags.
// Given name n and value v, it returns " n = 'v' "
function attributeStr(n, v) { return ' ' + n + '=' + sq(v) + ' ' }

// Given an array of strings, e.g., a = ['foo', 'bar', 'baz'], return a
// parenthesized parameter list: "(foo, bar, baz)".
function parameterStr(a) { return parens(a.join(',')); }

// A complete function call as a string
function funCallStr(f, a) { return f + parameterStr(a); }

// An escaped query string, exclusive of '?'
function queryStr(h)
{
    var a = [];
    for (k in h)
	a.push(escape(k) + '=' + escape(h[k]));
    return a.join('&');
}

// A random string generator
function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 8;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}