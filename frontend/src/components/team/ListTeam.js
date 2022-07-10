import React, { useState } from 'react';
import { TextField } from '@mui/material';
import Team from "./Team";

function ListTeam() {

    const [teams, setTeams] = useState([]);
    const [pokemonTypeFilter, setPokemonTypeFilter] = useState('');

    React.useEffect(() => {
        fetch(process.env.REACT_APP_BACK_END_API + '/team/')
            .then(res => res.json())
            .then(data => setTeams(data.teams));
    }, []);
    //filter team by Pokemon name
    const filteredTeams = pokemonTypeFilter === '' ? (
        teams
    ) : (
        teams.filter(team => {
            //check for all the pokemon
            return team.pokemonList.find(pk => {
                //check for all the type
                return pk.types.find(tp => {
                    return tp === pokemonTypeFilter;
                });
            })
        }
        )
    );

    const handleChange = (event) => {
        setPokemonTypeFilter(event.target.value);
    }

    return (
        <div style={{
            paddingTop: "50px",
            textAlign: "center"
        }}>

            <form style={{ padding: "10px" }}>
                <TextField
                    onChange={handleChange}
                    id="outlined-required"
                    label="Filter by pokemon type"
                    name="name"
                    value={pokemonTypeFilter}
                />

            </form>
            {
                filteredTeams.length === 0 ? (
                    <p>No team found.</p>
                ) : (
                    filteredTeams.map((team) => {
                        return <Team team={team} key={team.id}/>
                    })
                )
            }
        </div >
    );
}

export default ListTeam;