class WeatherForm extends React.Component {
    
    constructor(props) {
        super(props);        
        this.state = {
            weatherLocation: '',
            requireLocation: '',
            weatherForecast: '',
            message: ''
        };
    }
    
    handleLocationChange = event => {
        this.setState({ weatherLocation: event.target.value }, () => {
            this.validateLocation();
        });
    };    
    validateLocation = () => {
        const { weatherLocation } = this.state;
        this.setState({
            requireLocation:
                weatherLocation.length > 0 ? null : 'Required'
        });
    };
    
    handleForecastChange = event => {
        this.setState({ weatherForecast: event.target.value });
    };

    handleSubmit = (event) => {
        
        if ( this.state.requireLocation !== null )
        {
            this.state.message += '\n- Location required (See samples)';
        }
        
        if ( this.state.message !== '' )
        {
            alert( 'Please address the following:' + this.state.message );
            event.preventDefault();
        }
        /*
        else
        {
            alert( 'OK?' );
            //event.preventDefault();
        }
        */
    }
    
    render() {
 
        return (
            <form method="post" onSubmit={this.handleSubmit} noValidate
                action="">
                <div className="form-group">
                    <label htmlFor="weatherLocation"
                        className="form-control-label">
                        Location (required):
                        <span className="invalid-feedback">
                            &nbsp;{this.state.requireLocation}
                        </span>
                    </label>
                    <input type="text"
                        list="locationSamples"
                        required="required"
                        data-error="Please enter Location"
                        name="weatherLocation"
                        id="weatherLocation"
                        className="form-control"
                        placeholder="Type a Location. (Select a Sample.)"                        
                        value={this.state.weatherLocation}
                        onBlur={this.validateLocation}
                        onChange={this.handleLocationChange} />
                    <datalist id="locationSamples">
                        <option value="San Jacinto">Sample: City Name</option>
                        <option value="63119">Sample postal code: US ZIP</option>
                        <option value="G2J">Sample postal code: Canada</option>
                        <option value="SW1">Sample postal code: UK</option>
                        <option value="iata:ORD">Samplecode: IATA (include "iata:" prefix)</option>
                        <option value="metar:EGLL">Sample code: METAR (include "metar:" prefix)</option>
                        <option value="41.881832,-87.623177">Sample: Latitude/Longitude</option>
                    </datalist>
        
                </div>
                <div className="form-group">                
                    <label htmlFor="weatherForecast"
                        className="form-control-label">
                        Forecast in Days (optional, up to 3):
                    </label>
                    <select
                        name="weatherForecast"
                        id="weatherForecast"
                        className="form-control"
                        value={this.state.weatherForecast}
                        onChange={this.handleForecastChange} >
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                
                <div className="form-group">
                    <button
                        type="submit"
                        className="btn btn-success btn-block"
                        value="Submit" >
                      SEND
                    </button>
                </div>
            </form>
        );
    }
}

ReactDOM.render(
    <WeatherForm />,
    document.getElementById('weather')
);