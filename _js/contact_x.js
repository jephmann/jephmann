class ContactForm extends React.Component {
    
    constructor(props) {
        super(props);        
        this.state = {
            contactName: '',
            contactEmail: '',
            contactSubject: '',
            contactBody: '',
            requireName: '',
            maxName: '',
            requireEmail: '',
            maxEmail: '',
            requireSubject: '',
            maxSubject: '',
            requireBody: '',
            maxBody: '',
            matchEmail: '',
            message: ''
        };
    }
    
    handleNameChange = event => {
        this.setState({ contactName: event.target.value }, () => {
            this.validateName();
        });
    };    
    validateName = () => {
        const { contactName } = this.state;
        this.setState({
            requireName:
                contactName.length > 0 ? null : 'Required',
            maxName:
                contactName.length < 250 ? null : 'Limit 250 characters'
        });
    }      
    
    handleSubjectChange = event => {
        this.setState({ contactSubject: event.target.value }, () => {
            this.validateSubject();
        });
    };
    validateSubject = () => {
        const { contactSubject } = this.state;
        this.setState({
            requireSubject:
                contactSubject.length > 0 ? null : 'Required',
            maxSubject:
                contactSubject.length < 250 ? null : 'Limit 250 characters'
        });
    };

    handleEmailChange = event => {
        this.setState({ contactEmail: event.target.value }, () => {
            this.validateEmail();
        });
    };    
    validateEmail = () => {
        const { contactEmail } = this.state;
        var rex = new RegExp(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[A-Za-z]+$/);
        this.setState({
            requireEmail:
                contactEmail.length > 0 ? null : 'Required.',
            matchEmail:
                rex.test(contactEmail) ? null : 'Improper email address.',
            maxEmail:
                contactEmail.length < 250 ? null : 'Limit 250 characters.'
        });
    }
    
    handleBodyChange = event => {
        this.setState({ contactBody: event.target.value }, () => {
            this.validateBody();
        });
    };
    validateBody = () => {
        const { contactBody } = this.state;
        this.setState({
            requireBody:
                contactBody.length > 0 ? null : 'Required',
            maxBody:
                contactBody.length < 1000 ? null : 'Limit 1000 characters'
        });
    }

    handleSubmit = (event) => {
        
        if ( this.state.requireName !== null )
        {
            this.state.message += '\n- Name Required.';
        }
        
        if ( this.state.maxName !== null )
        {
            this.state.message += '\n- Name limit: 1000 characters.';
        }
        
        if ( this.state.requireEmail !== null )
        {
            this.state.message += '\n- E-mail Required.';
        }
        
        if ( this.state.matchEmail !== null )
        {
            this.state.message += '\n- Improper e-mail address.';
        }
        
        if ( this.state.maxEmail !== null )
        {
            this.state.message += '\n- E-mail limit: 250 characters.';
        }
        
        if ( this.state.requireSubject !== null )
        {
            this.state.message += '\n- Subject Required.';
        }
        
        if ( this.state.maxSubject !== null )
        {
            this.state.message += '\n- Subject limit: 250 characters.';
        }
        
        if ( this.state.requireBody !== null )
        {
            this.state.message += '\n- Body Required.';
        }
        
        if ( this.state.maxBody !== null )
        {
            this.state.message += '\n- Body limit: 1000 characters.';
        }
        
        if ( this.state.message !== '' )
        {
            alert( 'Please address the following:' + this.state.message );
            event.preventDefault();
        }
    }
  
    render() {
 
        return (
            <form method="post" onSubmit={this.handleSubmit} noValidate
                action="">
                <div className="form-group required">
                    <label htmlFor="contactName"
                        className="form-control-label">
                        Name:
                        <span className="invalid-feedback">
                            &nbsp;{this.state.requireName}
                            &nbsp;{this.state.maxName}
                        </span>
                    </label>
                    <input type="text"
                        required="required"
                        data-error="Please enter your name"
                        name="contactName"
                        id="contactName"
                        className="form-control"
                        placeholder="Enter name"                        
                        value={this.state.contactName}
                        onBlur={this.validateName}
                        onChange={this.handleNameChange} />
                </div>
                <div className="form-group required">
                    <label htmlFor="contactEmail"
                        className="form-control-label">
                        E-Mail:
                        <span className="invalid-feedback">
                            &nbsp;{this.state.requireEmail}
                            &nbsp;{this.state.maxEmail}
                            &nbsp;{this.state.matchEmail}
                        </span>
                    </label>
                    <input type="email"
                        required="required"
                        data-error="Please enter your name"
                        name="contactEmail"
                        id="contactEmail"
                        className="form-control"
                        placeholder="Enter e-mail"
                        value={this.state.contactEmail}
                        onBlur={this.validateEmail}
                        onChange={this.handleEmailChange} />
                </div>
                <div className="form-group required">
                    <label htmlFor="contactSubject"
                        className="form-control-label">
                        Subject:
                        <span className="invalid-feedback">
                            &nbsp;{this.state.requireSubject}
                            &nbsp;{this.state.maxSubject}
                        </span>
                    </label>
                    <input type="text"
                        required="required"
                        data-error="Please enter your name"
                        name="contactSubject"
                        id="contactSubject"
                        className="form-control"
                        placeholder="Enter subject"
                        value={this.state.contactSubject}
                        onBlur={this.validateSubject}
                        onChange={this.handleSubjectChange} />
                </div>
                <div className="form-group required">
                    <label htmlFor="contactBody"
                        className="form-control-label">
                        Message:
                        <span className="invalid-feedback">
                            &nbsp;{this.state.requireBody}
                            &nbsp;{this.state.maxBody}
                        </span>
                    </label>
                    <textarea
                        required="required"
                        data-error="Please enter your name"
                        name="contactBody"
                        id="contactBody"
                        className="form-control"
                        placeholder="Type in your text"
                        rows="12"
                        value={this.state.contactBody}
                        onBlur={this.validateBody}
                        onChange={this.handleBodyChange} />
                </div>
                <div className="form-group">
                    <button type="submit" className="btn btn-success btn-block">
                      SEND
                    </button>
                </div>
            </form>
        );
    }
}

ReactDOM.render(
    <ContactForm />,
    document.getElementById('contact')
);

