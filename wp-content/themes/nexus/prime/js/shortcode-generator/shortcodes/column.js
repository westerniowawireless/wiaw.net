primeShortcodeMeta = {
    attributes:[
        {
            label:"Columns",
            id:"content",
            controlType:"column-control"
        }
    ],
    disablePreview:true,
    customMakeShortcode: function(b) {



// Reduce a fraction by finding the Greatest Common Divisor and dividing by it.
        function reduce(numerator, denominator) {
            var gcd = function gcd(a, b) {
                return b ? gcd(b, a % b) : a;
            };
            gcd = gcd(numerator, denominator);
            return [numerator / gcd, denominator / gcd];
        }


        var returnString = "";
        if (b.data) {
            var numerators = ['', 'one', 'two', 'three', 'four', 'five', 'six'];
            var denominators = ['', '', 'half', 'third', 'fourth', 'fifth', 'sixth'];
            var coldata = b.data;

            var columnStrings = coldata.content.split("|");


            for (var h in columnStrings) {

                var d = jQuery.trim(columnStrings[h]);
                var subcolumnCount = d.length;

                if (subcolumnCount > 0) {
                    colFrac = reduce(subcolumnCount, coldata.numColumns);
                    var scName = numerators[colFrac[0]] + '_' + denominators[colFrac[1]];

                    if (h == columnStrings.length - 1)scName += "_last";

                    returnString += '[' + scName + ']Column ' + colFrac[0] + '/' + colFrac[1] + '[/' + scName + ']'
                }
            }
        }
        return returnString
    }
};