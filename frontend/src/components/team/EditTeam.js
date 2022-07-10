import React, {useState} from 'react';
import {useParams, useNavigate} from 'react-router-dom';
import {Button, TextField} from "@mui/material";
import {toast} from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import Team from "./Team";


function EditTeam() {
    const navigate = useNavigate();
    const params = useParams();
    const [team, setTeam] = useState([]);
    const [teamName, setTeamName] = useState('');

    function handleChange(event) {
        try {
            setTeamName(event.target.value);
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    function handleChangeNameSubmit(event) {
        try {
            fetch(process.env.REACT_APP_BACK_END_API + '/team/' + params.idTeam, {
                method: "PATCH",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({name: teamName})
            })
                .then(res => res.json())
                .then(data => {
                    toast.success(data.message);
                    team.name = teamName;
                    setTeam(team);
                    setTeamName(team.name);
                });
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    function handleDeleteTeamSubmit(event) {
        try {
            event.preventDefault();
            fetch(process.env.REACT_APP_BACK_END_API + '/team/' + params.idTeam, {
                method: "DELETE",
            })
                .then(res => res.json())
                .then(data => {
                    toast.success(data.message);
                    navigate('/');
                });
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    React.useEffect(() => {
        fetch(process.env.REACT_APP_BACK_END_API + '/team/' + params.idTeam)
            .then(res => {
                if(res.status !== 200){
                    return navigate('/team/list');
                }
                return res.json();
            })
            .then(data => {
                console.log(data);
                setTeam(data.team);
                setTeamName(team.name);
            });
    }, []);

    return (

        <div style={{
            paddingTop: "50px",
            textAlign: "center"
        }}>

            <TextField
                sx={{paddingRight: "10px"}}
                id="outlined-required"
                label="Change team name"
                onChange={handleChange}
                value={teamName}
            />
            <form style={{padding: "10px"}} onSubmit={handleChangeNameSubmit}>
                <Button variant="contained" type='submit' color='primary'>
                    Change team name
                </Button>
            </form>
            <form style={{padding: "10px"}} onSubmit={handleDeleteTeamSubmit}>
                <Button variant="contained" type='submit' color='error'>
                    Delete team
                </Button>
            </form>
            {
                team !== [] && <Team team={team}/>
            }
        </div>
    );
}

export default EditTeam;