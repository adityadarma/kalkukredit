numeral.language('id', {
    delimiters: {
       thousands: '.',
       decimal: ','
    },
    abbreviations: {
       thousand: 'k',
       million: 'm',
       billion: 'b',
       trillion: 't'
    },
    ordinal : function (number) {
       return number === 1 ? 'er' : 'ème';
    },
    currency: {
       symbol: 'Rp'
    }
});
// switch between languages
numeral.language('id');