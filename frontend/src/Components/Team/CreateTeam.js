import React from 'react';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import TextField from '@mui/material/TextField';
import Button from '@mui/material/Button';

toast.configure();

function CreateTeam() {
    const [teamDetail, setTeamDetail] = React.useState({ name: "" });
    const [teamId, setTeamId] = React.useState([]);
    const [btnAddPokemonDisabled, setBtnAddPokemonDisabled] = React.useState(true);

    function handleChange(event) {
        try {
            setTeamDetail(prevTeamDetail => {
                return {
                    ...prevTeamDetail,
                    [event.target.name]: [event.target.value]
                }
            })
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    function handleClick(event) {
        try {
            event.preventDefault();
            if (teamId != null && teamId !== "") {
                fetch(process.env.REACT_APP_BACK_END_API + '/pokemon/' + teamId, {
                    method: "POST",
                })
                    .then(res => res.json())
                    .then(data => toast.success(data.message));
            }
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    function createClick(event) {
        if (teamDetail.name === "") {
            toast.error("Team name can't be an empty string!");
        }
        try {
            event.preventDefault();
            fetch(process.env.REACT_APP_BACK_END_API + '/team/create/' + teamDetail.name, {
                method: "POST",
            })
                .then(res => res.json())
                .then(data => {
                    setTeamId(data.team.id);
                    toast.success(data.message);
                    setBtnAddPokemonDisabled(false);
                });
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    return (
        <div style={{
            paddingTop: "100px",
            textAlign: "center",
        }}>
            <form onSubmit={createClick} style={{ padding: "10px" }}>

                <TextField
                    required
                    onChange={handleChange}
                    id="outlined-required"
                    label="New team name"
                    name="name"
                    value={teamDetail.name}
                />
                <div style={{
                    paddingTop: "50px",
                    textAlign: "center",
                }}></div>
                <Button variant="contained" type='submit'>Create Team</Button>
            </form>
            <form onSubmit={handleClick} style={{ padding: "10px" }}>
                <Button disabled={btnAddPokemonDisabled} variant="contained" type='submit' color='success'>Gotta Catch 'Em All</Button>
            </form>
        </div>
    );
}

export default CreateTeam;