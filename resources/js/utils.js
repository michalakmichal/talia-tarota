// casts should be an object where the keys are params that might appear in the route, and the values specify how to cast the parameters
export function castRouteParams(casts) {
    return (route) => {
        const props = {};
        for (var key in route.params) {
            const rawValue = route.params[key];
            const cast = casts[key];
            if (rawValue == null) {
                // Don't attempt to cast null or undefined values
                props[key] = rawValue;
            } else if (cast == null) {
                // No cast specified for this parameter
                props[key] = rawValue;
            } else if (cast == 'integer') {
                // Try to cast this parameter as an integer
                const castValue = Number.parseInt(rawValue, 10);
                props[key] = isNaN(castValue) ? rawValue : castValue;
            } else if (cast == 'boolean') {
                // Try to cast this parameter as a boolean
                if (rawValue === 'true' || rawValue === '1') {
                    props[key] = true;
                } else if (rawValue === 'false' || rawValue === '0') {
                    props[key] = false;
                } else {
                    props[key] = rawValue;
                }
            } else if (typeof(cast) == 'function') {
                // Use the supplied function to cast this param
                props[key] = cast(rawValue);
            } else {
                console.log("Unexpected route param cast", cast);
                props[key] = rawValue;
            }
        }
        return props;
    };
};

export function randomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
/*
export function attachAdminStore(next)
{
    next(vm => vm.$store = import('./Admin/Store/index.js') );
} */